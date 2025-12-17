<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Resident;
use App\Observers\ResidentObserver;

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
        // Register observers
        Resident::observe(ResidentObserver::class);
        \App\Models\KK::observe(\App\Observers\KKObserver::class);
    }
}