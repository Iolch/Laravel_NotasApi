<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeniusApiController;
use App\Http\Controllers\SpotifyApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('genius/annotation/{token}', [GeniusApiController::class, 'annotations']);
Route::get('genius/search/{token}', [GeniusApiController::class, 'search']);
Route::get('spotify/login', [SpotifyApiController::class, 'login']);
Route::get('spotify/callback', [SpotifyApiController::class, 'callback']);