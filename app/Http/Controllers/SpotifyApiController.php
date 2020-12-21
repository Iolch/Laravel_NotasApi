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
        
        dd("iai");
        $code = $request->code;
        $state = $request->state;
        $stored_state = $request->cookie($this->state_key);
        dd($state);
        if($state === null || $state !== $stored_state){

        }else{

        }
    }
}
