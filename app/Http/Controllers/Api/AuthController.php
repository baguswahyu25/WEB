<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $user->sendEmailVerificationNotification();

    $token = $user->createToken('mobile_token')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil, silakan cek email untuk verifikasi',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user,
    ], 201);
}


    // LOGIN
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !\Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Email atau password salah'
        ], 401);
    }

    // 🔑 INI YANG KAMU BELUM PUNYA
    $token = $user->createToken('android')->plainTextToken;

    return response()->json([
        'message' => 'Login berhasil',
        'status' => true,
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
}

    // GET USER PROFILE
// GET USER PROFILE (Ringkas, tanpa accessor)
public function user(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'message' => 'Unauthenticated',
            'force_logout' => true
        ], 401);
    }

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'email_verified_at' => $user->email_verified_at,
        // langsung ambil dari database, tanpa accessor
        'profile_photo_url' => $user->profile_photo_url ?? null,
    ]);
}



    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
