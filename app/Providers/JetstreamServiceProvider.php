<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Tidak perlu apa-apa di sini, biarkan kosong untuk menjaga performa.
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Konfigurasi permission Jetstream
        $this->configurePermissions();

        // Mengatur handler penghapusan user
        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Prefetch asset Vite agar UI lebih cepat (fitur Laravel 10+)
        if (class_exists(Vite::class)) {
            Vite::prefetch(concurrency: 3);
        }
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        // Default permission token API
        Jetstream::defaultApiTokenPermissions(['read']);

        // Semua permission standar Jetstream
        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
