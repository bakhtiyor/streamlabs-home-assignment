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
        $this->twitchRepository->initHttp(env('TWITCH_URL'),
                    [
                        'token'=>Auth::user()->twitch_token,
                        'client_id'=>env('TWITCH_CLIENT_ID')
                    ]);
        $this->twitchRepository->fetchListOfTags();
    }

    public function getTopLiveStreams()
    {
        $this->twitchRepository->getTopLiveStreams();
    }

    public function dashboard()
    {
        return view('twitch.dashboard');
    }
}
