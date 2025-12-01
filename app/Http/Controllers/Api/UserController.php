<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();
    // Tambahkan LOG DI SINI
    \Log::info('USER UPDATE REQUEST', $request->all());
    \Log::info('AUTH USER', ['id' => $user?->id, 'email' => $user?->email]); 
        \Log::info('=== UPDATE HIT ===');
    \Log::info('HEADERS', $request->headers->all());
    \Log::info('BODY', $request->all());
    \Log::info('FILES', $request->file());

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update name
        $user->name = $request->name;

        // Upload avatar jika ada
        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')->store('avatars', 'public');

            $user->avatar_url = url('storage/' . $path);
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated',
            'user' => $user
        ]);
    }
}
