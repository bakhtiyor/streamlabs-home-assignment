<?php

use App\Http\Controllers\AuthenticationController;
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

Route::get('login-with-twitch', [AuthenticationController::class, 'loginWithTwitch'])->name('login-with-twitch');
Route::get('twitch-callback', [AuthenticationController::class, 'twitchCallback'])->name('twitch-callback');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
});
