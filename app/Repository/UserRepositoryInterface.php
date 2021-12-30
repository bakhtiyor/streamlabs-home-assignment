<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param $id
     * @return bool
     */
    public function findByTwitch($twitchId):?User;

    public function store($twitchUserName, $twitchUserEmail, $twitchUserId, $twitchUserLogin, $twitchUserToken, $twitchUserRefreshToken):User;

    public function refreshToken($twitchId, $token, $refreshToken);
}
