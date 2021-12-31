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
    Route::get('/median-for-all-streams', [DashboardController::class, 'getMedianForAllStreams'])->name('median-for-all-streams');
    Route::get('/top100-streams', [DashboardController::class, 'getTop100Streams'])->name('top100-streams');
    Route::get('/streams-by-hour', [DashboardController::class, 'getStreamsByHour'])->name('streams-by-hour');
    Route::get('/user-streams', [DashboardController::class, 'getUserStreams'])->name('user-streams');
    Route::get('/user-distance-to-top', [DashboardController::class, 'getUserDistanceToTop'])->name('user-distance-to-top');
    Route::get('/shared-tags', [DashboardController::class, 'getSharedTags'])->name('shared-tags');
//    Route::get('/game-streams', [DashboardController::class, 'getTotalNumberOfStreams'])->name('game-streams');
    Route::get('/fetch-top-streams',[TwitchController::class, 'fetchTopStreams']);
    Route::get('/fetch-user-streams',[TwitchController::class, 'fetchUserStreams'])->name('fetch-user-streams');
    Route::get('/fetch-list-of-tags',[TwitchController::class, 'fetchListOfTags']);
});

Route::get('login-with-twitch', [AuthenticationController::class, 'loginWithTwitch'])->name('login-with-twitch');
Route::get('twitch-callback', [AuthenticationController::class, 'twitchCallback'])->name('twitch-callback');
Route::get('/login',[AuthenticationController::class, 'login'])->name('login');
Route::post('/logout',[AuthenticationController::class, 'logout'])->name('logout');
