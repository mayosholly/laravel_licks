<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\TestNotificate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class TestAutomate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-automate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user  = User::all();
        Notification::route('mail', $user)->notify(new TestNotificate);

    }
}
