<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FcmController extends Controller
{
    public function storeToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        DB::table('fcm_tokens')->updateOrInsert(
            [
                'user_id' => $request->user()->id
            ],
            [
                'token' => $request->token,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return response()->json([
            'message' => 'FCM token saved'
        ]);
    }
}
