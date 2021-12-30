<?php

namespace App\Repository\Eloquent;

use App\Models\Stream;

class DashboardRepository implements \App\Repository\DashboardRepositoryInterface
{

    public function getTotalNumberOfStreams()
    {
        return Stream::selectRaw('game_name, count(game_name) as total')
                    ->where('game_name', '<>', null)
                    ->orderBy('total', 'desc')
                    ->groupBy('game_name')
                    ->paginate(env('ROWS_PER_PAGE'));
    }
}
