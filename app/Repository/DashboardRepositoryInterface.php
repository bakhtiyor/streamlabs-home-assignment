<?php

namespace App\Repository;

interface DashboardRepositoryInterface
{
    public function getTotalNumberOfStreams();
    public function getTopGames();
}
