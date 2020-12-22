<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;

class SpotifyApiController extends Controller
{  
    private $spotify_url = 'https://accounts.spotify.com/' ;
    private $state_key = 'spotify_auth_state';

    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    public function login(){

        $state = $this->generateRandomString(16);
        
        $data = array(
            'response_type' => 'code',
            'client_id' => env('SPOTIFY_CLIENT_ID'),
            'redirect_uri' => env('SPOTIFY_REDIRECT_URL'),
            'scope' => 'user-read-private user-read-email user-read-playback-state',
            'state'=> $state
        );
        $url = "{$this->spotify_url}authorize?".http_build_query($data);

        return Redirect::to($url)->withCookie(cookie($this->state_key, $state));
        
    }
    public function callback(Request $request){
        
        $code = $request->code;
        $state = $request->state;
        $stored_state = $request->cookie($this->state_key);
        
        if($state === null || $state !== $stored_state){
            dd($request->json());
        }else{
            \Cookie::queue(\Cookie::forget($this->state_key));

            $response = Http::asForm()->withBasicAuth(env('SPOTIFY_CLIENT_ID'), env('SPOTIFY_CLIENT_SECRET'))
                        ->post("{$this->spotify_url}api/token",[
                            'code' => $code,
                            'redirect_uri' => env('SPOTIFY_REDIRECT_URL'),
                            'grant_type' => 'authorization_code'
                            
                        ]);
            if(!array_key_exists('error', $response->json())){
                $data = array(
                    'access_token' => $response->json()['access_token'],
                    'refresh_token' => $response->json()['refresh_token']
                );

                $url = env('SITE_URL').http_build_query($data);
                return Redirect::to($url)->withCookie(cookie($this->state_key, $state));
            }else{
                dd($response->json());
            }
        }
    }
}
