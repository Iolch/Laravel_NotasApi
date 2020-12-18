<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GeniusApiController extends Controller
{
    private $genius_url = 'https://api.genius.com/' ;
    public function annotations($token){
        $response = Http::withToken(env('GENIUS_ACCESS_TOKEN'))
                    ->get("{$this->genius_url}annotations/{$token}");
        return $response->json();
    }
}
