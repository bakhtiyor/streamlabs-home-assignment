<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function loginWithTwitch()
    {
        return Socialite::driver('twitch')
            ->scopes(['user:read:follows', 'analytics:read:games'])
            //->with(['state' => 'randomstate'])
            ->redirect();
    }

    function twitchCallback()
    {
        $twitchUser = Socialite::driver('twitch')->user();

        if (is_null($twitchUser))
            return redirect(404);

        $twitchUserId = $twitchUser->getId();
        $twitchUserEmail = $twitchUser->getEmail();
        $twitchUserName = $twitchUser->getName();
        $twitchUserLogin = $twitchUser->user['login'];
        $twitchUserToken = $twitchUser->token;

        $user = $this->userRepository->findByTwitch($twitchUser->getId());
        if ($user) {
            $this->userRepository->refreshToken($twitchUserId, $twitchUserToken);
        }else{
            $user = $this->userRepository->store($twitchUserName, $twitchUserEmail, $twitchUserId, $twitchUserLogin, $twitchUserToken);
        }
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

}
