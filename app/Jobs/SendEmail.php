<?php

namespace App\Jobs;

use App\Notifications\RegisteredUserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */ 
    public function handle(): void
    {
        // dd($this->user);
        // Notification::route('mail', $this->user->email)->notify(new RegisteredUserNotification());
        foreach($this->user as $user){
           info($user->email);
           $user->notify(new RegisteredUserNotification());
           sleep(2);
        // Notification::route('mail', $user->email)->notify(new RegisteredUserNotification());

        }
    }
}
