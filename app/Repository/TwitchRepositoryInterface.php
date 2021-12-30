<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface TwitchRepositoryInterface
{
    public function init($url, $headers);
    public function fetchListOfTags();
}
