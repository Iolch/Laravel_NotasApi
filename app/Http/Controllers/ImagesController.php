<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function getRandom()
    {
        $files = Storage::disk('public')->allFiles('images');
        $random = rand() % count($files);
        $randomImagePath = public_path('storage/'.$files[$random]); // isso deveria ser storage_path?
        return response()->file($randomImagePath);
    }
}
