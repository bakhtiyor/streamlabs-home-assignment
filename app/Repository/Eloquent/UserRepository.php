<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function findByTwitch($twitchId):?User
    {
        return User::where('twitch_id', $twitchId)->first();
    }

    public function store($twitchUserName, $twitchUserEmail, $twitchUserId, $twitchUserLogin, $twitchUserToken): User
    {
        return User::create([
            'name' => $twitchUserName,
            'email' => $twitchUserEmail,
            'twitch_id' => $twitchUserId,
            'twitch_token' =>$twitchUserToken,
            'twitch_login' =>$twitchUserLogin,
        ]);
    }

    public function refreshToken($twitchId, $token)
    {
        User::where('twitch_id', $twitchId)->update([]);
    }
}
