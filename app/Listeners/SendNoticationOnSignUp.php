<?php

namespace App\Listeners;

use App\Events\Register;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNoticationOnSignUp
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Register $event): void
    {
        $user = $event->user;
        // $user->notify(new RegisteredUserNotification);
    Notification::route('mail', $user->email)->notify(new RegisteredUserNotification());
    }
}
