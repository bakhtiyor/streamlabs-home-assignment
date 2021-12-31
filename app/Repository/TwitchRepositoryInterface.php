<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface TwitchRepositoryInterface
{
    public function init($params);
    public function fetchListOfTags();
    public function fetchTopStreams();
    public function fetchUserStreams();
}
