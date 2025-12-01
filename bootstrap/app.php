<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // --- Middleware Global / Alias ---
        $middleware->alias([
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        ]);

        // --- Grup middleware WEB (Disimplifikasi) ---
        $middleware->web(append: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class, 
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            
            // INI ADALAH MIDDLEWARE OTENTIKASI UTAMA UNTUK JETSTREAM
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class, 
            
            // [TINDAKAN] SubstituteBindings Dihapus dari 'web' untuk mencegah konflik RequestGuard/SessionGuard
            
        ])
        ->validateCsrfTokens(except: [
            // ...
        ]);
        
        // --- Grup middleware API ---
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:60,1',
            
            // SubstituteBindings HANYA ada di sini
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();