<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\CustomResetPasswordController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SnapPaymentController;


/*
|--------------------------------------------------------------------------
| ROUTE USER (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 1. Dari card paket → form pendaftaran
    Route::post('/bayar', 
        [BayarController::class, 'show']
    )->name('bayar.show');

    // 2. Submit form pendaftaran → buat transaksi
    Route::post('/payment', 
        [PaymentController::class, 'store']
    )->name('payment.store');

    // 3. Redirect ke Midtrans Snap
    Route::get('/payment/snap/{pendaftaran_id}', 
        [SnapPaymentController::class, 'show']
    )->name('payment.snap');
});


/*
|--------------------------------------------------------------------------
| ROUTE Profile
|--------------------------------------------------------------------------
*/

    Route::get('/profile/keamanan', function () {
        return view('profile.keamanan'); 
    })->name('profile.keamanan');

     Route::get('/profile/notifications', function () {
        return view('profile.notifications'); 
    })->name('profile.notifications');



    /*
|--------------------------------------------------------------------------
| ROUTE USER (LOGIN)
|--------------------------------------------------------------------------
*/

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
    return view('support');
});

Route::get('/daftar', function () {
    return view('pembayaran');
});

// rute perantara (tetap sama)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // PERBAIKAN DI SINI: Tambahkan middleware 'is_user'
    Route::get('/user/dashboard', function () {
        return view('index'); 
    })->name('user.dashboard')->middleware('is_user'); // <--- Tambahkan pagar ini
});

// 3. Rute Khusus Admin (File: resources/views/admin/dashboard.blade.php)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Mengarah ke folder admin/dashboard
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