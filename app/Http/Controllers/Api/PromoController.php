<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use App\Services\FirebaseNotificationService;
use App\Models\FcmToken;

class PromoController extends Controller
{
    public function index()
    {
        return response()->json(
            Promo::where('is_active', true)->latest()->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            Promo::where('id', $id)
                ->where('is_active', true)
                ->firstOrFail()
        );
    }

    // ===============================
    // KIRIM NOTIFIKASI PROMO (FCM)
    // ===============================
    public function sendPromoNotification(
        FirebaseNotificationService $firebase
    ) {
        $tokens = FcmToken::pluck('token');

        foreach ($tokens as $token) {
            $firebase->sendToToken(
                $token,
                'Promo Baru!',
                'Diskon spesial hari ini'
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi promo berhasil dikirim'
        ]);
    }
}

