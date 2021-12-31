<?php

namespace App\Http\Controllers;

use App\Repository\DashboardRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getTopGames()
    {
        $data = $this->dashboardRepository->getTopGames();
        return view('dashboard.top-games', ['data'=>$data]);
    }
    public function getTotalNumberOfStreams()
    {
        $data = $this->dashboardRepository->getTotalNumberOfStreams();
        return view('dashboard.game-streams', ['data'=>$data]);
    }

    public function getMedianForAllStreams()
    {
        $data = $this->dashboardRepository->getMedianForAllStreams();
        return view('dashboard.median-streams', ['data'=>$data]);
    }

    public function getTop100Streams(Request $request)
    {
        $orderBy = ($request->has('orderby')) ? $request->get('orderby') : 'desc';
        $data = $this->dashboardRepository->getTop100Streams($orderBy);
        return view('dashboard.top-100-streams', ['data'=>$data]);
    }

    public function getStreamsByHour(Request $request)
    {
        $data = $this->dashboardRepository->getStreamsByHour();
        return view('dashboard.streams-by-hour', ['data'=>$data]);
    }

    public function getUserStreams(Request $request)
    {
        $data = $this->dashboardRepository->getUserStreams();
        return view('dashboard.user-streams', ['data'=>$data]);
    }
}
