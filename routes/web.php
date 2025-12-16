<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\CustomResetPasswordController;
use App\Http\Controllers\WebSocketController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('index');
});

Route::get('/paket', function () {
    return view('paketkursus');
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

    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications/connect', [WebSocketController::class, 'connect']);
    Route::post('/notifications/send', [NotificationController::class, 'send']); // untuk push notif
});