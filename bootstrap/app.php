<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // --- 1. Konfigurasi Routing ---
    // Mengatur lokasi file route untuk web, api, console, dll.
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    
    // --- 2. Konfigurasi Middleware ---
    ->withMiddleware(function (Middleware $middleware): void {
        
        // --- Alias Middleware ---
        // Digunakan untuk memberi nama pendek pada class middleware agar mudah dipanggil di web.php
        $middleware->alias([
            // Alias bawaan untuk menjaga sesi autentikasi
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            
            // Middleware kustom untuk mengecek apakah user aktif
            'check.active' => \App\Http\Middleware\CheckUserActive::class, 
            
            // Middleware inti untuk memisahkan akses Admin (Hanya role admin yang bisa lewat)
            'admin' => \App\Http\Middleware\IsAdmin::class,              
            
            // Middleware inti untuk memisahkan akses User (Admin tidak bisa ngintip area User)
            'is_user' => \App\Http\Middleware\IsUser::class, 

            // Alias standar untuk pengecekan login (sudah ada di Laravel, tapi didefinisikan ulang tidak masalah)
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,    
        ]);
        
        // --- Grup Middleware WEB ---
        // Middleware yang berjalan setiap kali user mengakses halaman website lewat browser
        $middleware->web(append: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,             // Enkripsi cookie
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Menambah cookie ke response
            \Illuminate\Session\Middleware\StartSession::class,             // Memulai session user
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,      // Membagikan variabel error ke view/blade
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,  // Sinkronisasi session khusus Jetstream
        ])

        // Mengecualikan beberapa URL dari pengecekan CSRF (misal: callback pembayaran dari pihak ketiga)
        ->validateCsrfTokens(except: [
            // 'bayar/callback', // Contoh jika ada callback API yang butuh akses tanpa CSRF
        ]);
        
        // --- Grup Middleware API ---
        // Middleware yang berjalan saat diakses lewat Mobile App atau sistem eksternal
        $middleware->api(prepend: [
            // Penting agar API mobile bisa mengenal session/state dari login
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:60,1', // Membatasi akses agar tidak kena spam (60 request per menit)
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Mengubah ID di URL jadi objek data database
        ]);
    })

    // --- 3. Penanganan Exception (Error) ---
    ->withExceptions(function (Exceptions $exceptions): void {
        // Di sini tempat mengatur jika terjadi error khusus (seperti 404, 500, dll)
    })

    // --- 4. Membangun Aplikasi ---
    ->create();