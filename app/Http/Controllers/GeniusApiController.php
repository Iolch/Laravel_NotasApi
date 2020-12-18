<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GeniusApiController extends Controller
{
    public function annotations(){
        
        $response = Http::withToken('e4e2vC2wgrlR6XAJC0-rURO4h3QAB7iNj0CaoqE7VoAtheQukpdtbThUe7CWH2cI')->get('https://api.genius.com/annotations/10225840');
        dd($response->json());
    }
}
