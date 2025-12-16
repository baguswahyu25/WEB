<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Api\ForgotPasswordController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\FormPendaftaranController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\BotController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/user/update', [ProfileController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json([
        'success' => true,
        'user' => $request->user()
    ]);
});
Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/pendaftaran', [FormPendaftaranController::class, 'store']);
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/faq', [FaqController::class, 'index']);
    Route::post('/faq', [FaqController::class, 'store']);
    Route::put('/faq/{id}', [FaqController::class, 'update']);
    Route::delete('/faq/{id}', [FaqController::class, 'destroy']);
});
/**
 * ===========================
 * BOT CHAT (USER)
 * ===========================
 */
Route::middleware(['auth:sanctum', 'throttle:30,1'])
    ->post('/bot/chat', [BotController::class, 'chat']);

/**
 * ===========================
 * BOT CS (KHUSUS CS)
 * ===========================
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cs/waiting-chats', [BotController::class, 'waitingChats']);
    Route::post('/cs/reply/{id}', [BotController::class, 'reply']);
});






