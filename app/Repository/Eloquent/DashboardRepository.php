<?php

namespace App\Repository\Eloquent;

use App\Models\Stream;
use App\Repository\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{

    public function getTotalNumberOfStreams()
    {
        return Stream::selectRaw('game_name, count(game_name) as total')
                    ->where('game_name', '<>', null)
                    ->orderBy('total', 'desc')
                    ->groupBy('game_name')
                    ->paginate(env('ROWS_PER_PAGE'));
    }

    public function getTopGames()
    {
        return Stream::selectRaw('game_name, viewer_count')
                    ->where('game_name', '<>', null)
                    ->orderBy('viewer_count', 'desc')
                    ->paginate(env('ROWS_PER_PAGE'));
    }
}
