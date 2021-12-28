<?php

namespace App\Repository\API;

use App\Models\Stream;
use App\Repository\TwitchRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TwitchRepository implements TwitchRepositoryInterface
{

    public function getTopLiveStreams()
    {
        $Stream = new Stream();
        $Stream->name = "Channel name ".random_int(1, 199);
        $Stream->title = "Channel title ".random_int(1, 199);
        $Stream->game = "Game ".random_int(1, 199);
        $Stream->viewers = random_int(122, 199323);
        $Stream->start_date = Carbon::now();
        $Stream->save();
        return $Stream;
    }
}
