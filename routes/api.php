<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\VerificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/email/verification/send', [VerificationController::class, 'sendEmail']);
Route::post('/send-verification-email', [VerificationController::class, 'sendVerificationEmail']);
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');