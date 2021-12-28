<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface TwitchRepositoryInterface
{
    public function getTopLiveStreams();
}
