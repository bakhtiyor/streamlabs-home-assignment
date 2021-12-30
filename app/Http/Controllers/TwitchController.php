<?php

namespace App\Http\Controllers;

use App\Repository\TwitchRepositoryInterface;
use Auth;

class TwitchController extends Controller
{
    private $twitchRepository;
    /**
     * @param $twitchRepository
     */
    public function __construct(TwitchRepositoryInterface $twitchRepository)
    {
        $this->twitchRepository = $twitchRepository;
    }

    public function fetchListOfTags()
    {
        $this->twitchRepository->init([
            'twitch_url' => env('TWITCH_URL'),
            'twitch_token_refresh_url' => env('TWITCH_TOKEN_REFRESH_URL'),
            'token'=>Auth::user()->twitch_token,
            'refresh_token'=>Auth::user()->twitch_refresh_token,
            'client_id'=>env('TWITCH_CLIENT_ID'),
            'client_secret'=>env('TWITCH_CLIENT_SECRET'),
            'twitch_id'=>Auth::user()->twitch_id
        ]);
        $this->twitchRepository->fetchListOfTags();
    }

    public function fetchTopStreams()
    {
        $this->twitchRepository->init([
            'twitch_url' => env('TWITCH_URL'),
            'twitch_token_refresh_url' => env('TWITCH_TOKEN_REFRESH_URL'),
            'token'=>Auth::user()->twitch_token,
            'refresh_token'=>Auth::user()->twitch_refresh_token,
            'client_id'=>env('TWITCH_CLIENT_ID'),
            'client_secret'=>env('TWITCH_CLIENT_SECRET'),
            'twitch_id'=>Auth::user()->twitch_id
        ]);
        $this->twitchRepository->fetchTopStreams();
    }

    public function dashboard()
    {
        return view('twitch.dashboard');
    }
}
