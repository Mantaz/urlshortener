<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UrlShortenerController::class, 'index'])
    ->name('urlShortener');
Route::post('/', [UrlShortenerController::class, 'store'])
    ->name('generateShortUrl');
Route::get('/{hash}', [UrlShortenerController::class, 'redirectToUrl'])
    ->name('redirectToUrl');
Route::get('/{folder}/{hash}', [UrlShortenerController::class, 'redirectToUrlWithFolder'])
    ->name('redirectToUrlWithFolder');
