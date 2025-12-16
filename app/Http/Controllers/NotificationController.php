<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'type' => 'nullable|string', // promo/jadwal/paket
        ]);

        $tokens = DeviceToken::pluck('token')->toArray();

        if(empty($tokens)){
            return response()->json(['message' => 'No device tokens found']);
        }

        $payload = [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => $request->title,
                'body' => $request->body,
            ],
            'data' => [
                'type' => $request->type ?? 'general',
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'key=' . env('FCM_SERVER_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', $payload);

        return $response->json();
    }
}
