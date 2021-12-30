<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Log;

class UserRepository implements UserRepositoryInterface
{

    public function findByTwitch($twitchId):?User
    {
        return User::where('twitch_id', $twitchId)->first();
    }

    public function store($twitchUserName, $twitchUserEmail, $twitchUserId, $twitchUserLogin, $twitchUserToken, $twitchUserRefreshToken): User
    {
        return User::create([
            'name' => $twitchUserName,
            'email' => $twitchUserEmail,
            'password' => bcrypt(random_int(100,200)),
            'twitch_id' => $twitchUserId,
            'twitch_token' =>$twitchUserToken,
            'twitch_refresh_token' =>$twitchUserRefreshToken,
            'twitch_login' =>$twitchUserLogin,
        ]);
    }

    public function refreshToken($twitchId, $token, $refreshToken)
    {
        User::where('twitch_id', $twitchId)->update([
            'twitch_token' =>$token,
            'twitch_refresh_token' =>$refreshToken,
        ]);
    }
}
