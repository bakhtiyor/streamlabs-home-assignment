<?php

use App\Http\Controllers\AuthenticationController;
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
    Route::get('/', [TwitchController::class, 'dashboard'])->name('twitch-dashboard')->middleware('auth');
    Route::get('/get-top-live-streams',[TwitchController::class, 'getTopLiveStreams']);
});

Route::get('login-with-twitch', [AuthenticationController::class, 'loginWithTwitch'])->name('login-with-twitch');
Route::get('twitch-callback', [AuthenticationController::class, 'twitchCallback'])->name('twitch-callback');
Route::get('/login',[AuthenticationController::class, 'login'])->name('login');
Route::post('/logout',[AuthenticationController::class, 'logout'])->name('logout');
