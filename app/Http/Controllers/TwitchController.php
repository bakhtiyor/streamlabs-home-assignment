<?php

namespace App\Http\Controllers;

use App\Repository\TwitchRepositoryInterface;

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


    public function getTopLiveStreams()
    {
        $this->twitchRepository->getTopLiveStreams();
    }

    public function dashboard()
    {
        return view('twitch.dashboard');
    }
}
