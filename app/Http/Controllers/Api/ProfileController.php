<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated'
        ], 401);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name = $validated['name'];

    if ($request->hasFile('profile_photo')) {

        $file = $request->file('profile_photo');

        if (!$file->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'File upload tidak valid'
            ], 422);
        }

        $filename = 'profile_' . $user->id . '_' . Str::random(20) . '.' . $file->extension();

        $path = $file->storeAs('profile-photos', $filename, 'public');

        if (!Storage::disk('public')->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan foto'
            ], 500);
        }

        if ($user->profile_photo_path &&
            Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->profile_photo_path = $path;
    }

    $user->save();

    return response()->json([
    'user' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'email_verified_at' => $user->email_verified_at,
        'profile_photo_url' => $user->profile_photo_path
            ? asset('storage/' . $user->profile_photo_path)
            : null,

    ]
], 200);

}

}
