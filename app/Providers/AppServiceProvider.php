<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

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
        // Log configuration on startup
        Log::debug('App configuration:', [
            'REDIS_HOST' => env('REDIS_HOST'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'DB_HOST' => env('DB_HOST'),
            'APP_ENV' => env('APP_ENV'),
        ]);
    }
}
