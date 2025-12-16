<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\CustomResetPasswordController;
use App\Http\Controllers\WebPendaftaranController;

Route::get('/bayar', [WebPendaftaranController::class, 'showForm'])->name('bayar.show');
Route::post('/bayar/init', [WebPendaftaranController::class, 'initPayment'])->name('bayar.init');
Route::post('/bayar/callback', [WebPendaftaranController::class, 'handleCallback'])->name('bayar.callback');


Route::get('/', function () {
    return view('index');
});

Route::get('/paket', function () {
    return view('paketkursus');
});

Route::get('/tentang', function () {
    return view('tentangkami');
});

Route::get('/layanan', function () {
    return view('layanankami');
});

Route::get('/support', function () {
    return view('suport');
});

Route::get('/daftar', function () {
    return view('pembayaran');
});

// Dashboard protect
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// routes/web.php
Route::get('/email-verified-success', function () {
    return view('email_verified_success');
});
Route::post('/reset-password', [CustomResetPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// Halaman sukses setelah reset
Route::get('/reset-password-success', function () {
    return view('auth.password-reset-success');
})->name('password.reset.success');



Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed'])   // hanya signed, supaya tidak 403
    ->name('verification.verify');
