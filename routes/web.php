<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('index');
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



Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed'])   // hanya signed, supaya tidak 403
    ->name('verification.verify');
