<?php

namespace App\Repository\Eloquent;

use App\Models\Stream;
use App\Models\UserStream;
use App\Repository\DashboardRepositoryInterface;
use Auth;
use Illuminate\Database\Query\Builder;

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

    public function getMedianForAllStreams()
    {
        $streamViewers =  Stream::select('viewer_count')->pluck('viewer_count')->toArray();
        return $this->calculcateMedian($streamViewers);
    }

    private function calculcateMedian($data)
    {
        sort($data);
        $dataSize = count($data);
        return ($dataSize % 2 == 0) ? ($data[$dataSize / 2 - 1] + $data[$dataSize / 2]) / 2 : $data[$dataSize / 2];
    }

    public function getTop100Streams($orderBy)
    {
        return Stream::selectRaw('title, thumbnail_url, viewer_count')
                            ->where('title', '<>', null)
                            ->orderBy('viewer_count', $orderBy)
                            ->take(100)
                            ->get();
    }

    public function getStreamsByHour()
    {
        return Stream::selectRaw("date_format(started_at, '%Y-%m-%d %H') datetime, count(*) as total")
                        ->groupBy("datetime")
                        ->orderBy('datetime', 'desc')
                        ->paginate(env('ROWS_PER_PAGE'));
    }

    public function getUserStreams()
    {
// I could do it using following query but I am implemented this task using application layer as required in the task
//        $userStreams = Stream::selectRaw('title, thumbnail_url, viewer_count')
//                            ->whereHas('userStreams', function($query){
//                                $query->where('user_id', Auth::user()->id);
//                            })->get();
        $topStreams = Stream::selectRaw('id, title, thumbnail_url, viewer_count')
                    ->take(1000)
                    ->where('title', '<>', null)
                    ->orderBy('viewer_count', 'desc')
                    ->get();
        $userStreams = UserStream::where('user_id', Auth::user()->id)->pluck('stream_id')->toArray();
        $selectedStreams = array();
        foreach($topStreams as $topStream){
            if (in_array($topStream->id, $userStreams)){
                $selectedStreams[] = $topStream;
            }
        }
        return $selectedStreams;
    }
}
