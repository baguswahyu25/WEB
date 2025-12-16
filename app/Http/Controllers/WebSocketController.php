<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebSocketController extends Controller
{
public function connect(Request $request)
{
    $host = env('WS_HOST', '127.0.0.1'); // bisa di .env
    $port = env('WS_PORT', 8080);

    return response()->json([
        'ws_url' => "ws://$host:$port?token=" . $request->user()->api_token
    ]);
}
}