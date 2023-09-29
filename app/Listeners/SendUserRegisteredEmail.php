<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\AccountInformation;
use Mail;

class SendUserRegisteredEmail implements ShouldQueue
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
    public function handle(UserRegisteredEvent $event)
    {
        // dd('flgkf');
        // try {

           $info = [
            'email' => $event->user->email,
            'name' => $event->user->name,

           ];

            Mail::to($event->user->email)->send(new AccountInformation($info));

        // } catch (\Throwable $th) {
        //     \Log::Info($th->getMessage());
        // }

    }
}
