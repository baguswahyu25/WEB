<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSimController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/form-store', [FormController::class, 'store']);
    Route::post('/email/resend', [VerificationController::class, 'resend'])
        ->name('api.verification.resend');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// ================================
// FORGOT PASSWORD (KIRIM LINK)
// ================================
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? response()->json(['message' => __($status)], 200)
        : response()->json(['message' => __($status)], 400);
});

// =======================================
// RESET PASSWORD (USER KLIK LINK EMAIL)
// =======================================
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])
    ->name('api.password.reset');

Route::post('/form/sim', [FormSimController::class, 'store']);
