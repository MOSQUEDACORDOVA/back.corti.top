<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('shorten', [UrlShortenerController::class, 'shorten']);
Route::get('urls', [UrlShortenerController::class, 'listUrls']);
Route::delete('/urls/{id}', [UrlShortenerController::class, 'deleteUrl']);
