<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TwitchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('web', 'auth')->group(function () {
    Route::get('/', [DashboardController::class, 'getTotalNumberOfStreams'])->name('twitch-dashboard');
    Route::get('/top-games', [DashboardController::class, 'getTopGames'])->name('top-games');
//    Route::get('/game-streams', [DashboardController::class, 'getTotalNumberOfStreams'])->name('game-streams');
    Route::get('/fetch-top-streams',[TwitchController::class, 'fetchTopStreams']);
    Route::get('/fetch-list-of-tags',[TwitchController::class, 'fetchListOfTags']);
});

Route::get('login-with-twitch', [AuthenticationController::class, 'loginWithTwitch'])->name('login-with-twitch');
Route::get('twitch-callback', [AuthenticationController::class, 'twitchCallback'])->name('twitch-callback');
Route::get('/login',[AuthenticationController::class, 'login'])->name('login');
Route::post('/logout',[AuthenticationController::class, 'logout'])->name('logout');
