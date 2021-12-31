<?php

namespace App\Repository;

interface DashboardRepositoryInterface
{
    public function getTotalNumberOfStreams();
    public function getTopGames();
    public function getMedianForAllStreams();
    public function getTop100Streams($orderBy);
    public function getStreamsByHour();
    public function getUserStreams();
    public function getNumViewersToMakeTop();
}
