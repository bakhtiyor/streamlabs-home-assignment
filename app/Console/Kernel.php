<?php

namespace App\Console;

use App\Models\User;
use App\Repository\API\TwitchRepository;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $TwitchRepository = resolve(\App\Repository\API\TwitchRepository::class);
            //getting Twitch token, refreshtoken from a DB instead of Auth::user() for a current user because due to the task assignment a cronjob should
            //run this task every 15min and Auth is not available there.
            $user = User::where('email', 'bakhtiyor.bahriddinov@gmail.com')->first();
            $TwitchRepository->init([
                'twitch_url' => env('TWITCH_URL'),
                'twitch_token_refresh_url' => env('TWITCH_TOKEN_REFRESH_URL'),
                'token'=>$user->twitch_token,
                'refresh_token'=>$user->twitch_refresh_token,
                'client_id'=>env('TWITCH_CLIENT_ID'),
                'client_secret'=>env('TWITCH_CLIENT_SECRET'),
                'twitch_id'=>$user->twitch_id
            ]);
            $TwitchRepository->fetchTopStreams();
        })
        ->name('fetch-top-streams')
        ->withoutOverlapping(5)
        ->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
