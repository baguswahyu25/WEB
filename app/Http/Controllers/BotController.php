<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\CsChat;
use App\Services\FcmService;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = strtolower(trim($request->message));

        // 1️⃣ BOT MATCH FAQ
        $faq = Faq::where('is_active', true)
            ->where('keyword', 'like', "%$message%")
            ->orderByRaw('LENGTH(keyword) DESC')
            ->first();

        if ($faq) {
            return response()->json([
                'success' => true,
                'source' => 'bot',
                'reply' => $faq->answer
            ]);
        }

        // 2️⃣ SIMPAN KE CS CHAT
        $chat = CsChat::create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'status' => 'waiting_cs'
        ]);

        return response()->json([
            'success' => true,
            'source' => 'cs',
            'reply' => 'Pesan kamu diteruskan ke Customer Service',
            'chat_id' => $chat->id
        ]);
    }

    public function reply(Request $request, $id, FcmService $fcm)
    {
        $request->validate([
            'reply' => 'required|string|max:500'
        ]);

        $cs = $request->user();
        if ($cs->role !== 'cs') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chat = CsChat::findOrFail($id);
        $chat->update([
            'reply' => $request->reply,
            'status' => 'answered'
        ]);

        $user = $chat->user;

        // 🔥 KIRIM NOTIF JIKA AKTIF
        if ($user->notif_cs) {
            foreach ($user->fcmTokens as $token) {
                $fcm->send(
                    $token->token,
                    'Balasan CS',
                    $request->reply,
                    ['chat_id' => (string)$chat->id]
                );
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Balasan terkirim'
        ]);
    }
}
