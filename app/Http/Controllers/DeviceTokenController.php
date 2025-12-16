<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceToken;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        DeviceToken::updateOrCreate(
            ['token' => $request->token],
            ['token' => $request->token]
        );

        return response()->json(['message' => 'Token saved']);
    }
}
