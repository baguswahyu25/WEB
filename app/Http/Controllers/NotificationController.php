<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebSocket\NotificationServer;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $userId = $request->input('user_id');
        $type = $request->input('type'); // pengingat / promo / produk / app_update
        $message = $request->input('message');

        $wsServer = app(NotificationServer::class);
        $wsServer->sendToUser($userId, compact('type','message'));

        return response()->json(['success' => true]);
    }
}
