<?php

namespace App\Console;

use App\Models\User;
use App\Notifications\TestNotificate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:test-automate')->everyMinute();
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function(){
            
            // $user =User::whereNull('email_verified_at')->get();
            // Notification::route('mail', $user)->notify(new TestNotificate);
            // $user->notify(new TestNotificate());
            // $user->delete();
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
