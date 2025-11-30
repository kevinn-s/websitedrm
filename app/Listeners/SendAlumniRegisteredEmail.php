<?php

namespace App\Listeners;

use App\Events\AlumniRegistered;
use App\Mail\RegistrationReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAlumniRegisteredEmail
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
    public function handle(AlumniRegistered $event): void
    {
        Mail::to($event->alumni)->send(new RegistrationReceived());
    }
}
