<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = $request->user();

        // ❌ password lama salah
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password lama salah'
            ], 401);
        }

        // ✅ update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // 🔐 logout semua device (opsional tapi bagus)
        $user->tokens()->delete();

        // ✅ RESPONSE SUKSES
        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah, silakan login ulang'
        ], 200);
    }
public function updateNotificationPreference(Request $request)
{
    $request->validate([
        'pengingat' => 'boolean',
        'promo' => 'boolean',
        'pembaruan_aplikasi' => 'boolean',
        'pembaruan_produk' => 'boolean',
    ]);

    $user = $request->user();

    $user->update([
        'notif_pengingat' => $request->pengingat,
        'notif_promo' => $request->promo,
        'notif_pembaruan' => $request->pembaruan_aplikasi,
    ]);

    return response()->json([
        'success' => true
    ]);
}
}
