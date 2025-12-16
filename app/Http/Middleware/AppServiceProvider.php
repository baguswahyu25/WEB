<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- WAJIB: Import Facade URL

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
        // Logika untuk memaksa skema HTTPS secara global.
        // Ini mengatasi masalah Mixed Content saat menggunakan Cloudflare/Proxy.

        // Periksa jika APP_ENV adalah production ATAU jika APP_URL sudah diatur sebagai HTTPS.
        if (env('APP_ENV') === 'production' || str_starts_with(config('app.url'), 'https://')) {
            
            // Perintah ini memaksa Laravel untuk menghasilkan SEMUA URL dengan HTTPS
            URL::forceScheme('https');
        }
    }
}