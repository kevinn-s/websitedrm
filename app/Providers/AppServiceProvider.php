<?php

namespace App\Providers;

use App\Events\AlumniRegistered;
use App\Listeners\NotifyAlumniOfVerification;
use App\Listeners\SendAlumniRegisteredEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            AlumniRegistered::class,
            SendAlumniRegisteredEmail::class
        );
    }
}
