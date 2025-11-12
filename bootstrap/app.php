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

        // --- Grup middleware WEB (Sudah Diperbaiki) ---
        $middleware->web(append: [
            // [FIX] Menggunakan namespace Illuminate untuk Cookie
            \Illuminate\Cookie\Middleware\EncryptCookies::class, 
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            
            // Standard session management
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class, // FIX 2FA
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            
            // Middleware Jetstream untuk memastikan sesi terotentikasi penuh
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class, 
        ])
        
        // [FIX] CSRF Token divalidasi menggunakan metode modern
        ->validateCsrfTokens(except: [
            // Masukkan rute API yang perlu dikecualikan dari CSRF di sini jika ada
        ]);
        
        // --- Grup middleware API ---
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();