<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTER
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    // ===========================
    // OTOMATIS KIRIM EMAIL VERIFIKASI
    // ===========================
    $user->sendEmailVerificationNotification();

    $token = $user->createToken('mobile_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ], 201);
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // CEK EMAIL VERIFIED
        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email belum diverifikasi. Silakan cek email Anda.',
                'status' => false
            ], 403);
        }
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Akun tidak ditemukan'], 404);
        }

        if ($user->deleted_at != null) {
            return response()->json(['message' => 'Akun telah dihapus'], 403);
        }


        // HAPUS TOKEN LAMA UNTUK KEAMANAN
        $user->tokens()->delete();

        // BUAT TOKEN BARU
        $token = $user->createToken('mobile_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'status' => true,
            'user' => $user,
            'token' => $token,
        ]);
    }

    // PROFILE USER
public function user(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }

    return response()->json($user);
}
    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}