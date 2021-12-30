<?php

namespace App\Repository\Eloquent;

use App\Models\Stream;
use App\Repository\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{

    public function getTotalNumberOfStreams()
    {
        return Stream::selectRaw('game_name, min(thumbnail_url) as thumbnail_url, count(game_name) as total')
                    ->where('game_name', '<>', null)
                    ->orderBy('total', 'desc')
                    ->groupBy('game_name')
                    ->paginate(env('ROWS_PER_PAGE'));
    }

    public function getTopGames()
    {
        return Stream::selectRaw('game_name, min(thumbnail_url) as thumbnail_url, sum(viewer_count) viewer_count')
                    ->where('game_name', '<>', null)
                    ->orderBy('viewer_count', 'desc')
                    ->groupBy('game_name')
                    ->paginate(env('ROWS_PER_PAGE'));
    }
}
