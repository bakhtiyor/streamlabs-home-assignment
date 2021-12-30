<?php

namespace App\Http\Controllers;

use App\Repository\DashboardRepositoryInterface;

class DashboardController extends Controller
{
    private $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getTotalNumberOfStreams()
    {
        $data = $this->dashboardRepository->getTotalNumberOfStreams();
        return view('dashboard.game-streams', ['data'=>$data]);
    }
}
