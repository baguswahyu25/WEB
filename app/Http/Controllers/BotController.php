<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\CsChat;
use Illuminate\Http\Request;

class BotController extends Controller
{
    /**
     * ===========================
     * CHAT BOT ENDPOINT
     * ===========================
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $message = strtolower(trim($request->message));

        /**
         * 1️⃣ PRIORITAS: FULL MATCH (paling relevan)
         */
        $faq = Faq::where('is_active', true)
            ->where('keyword', 'like', "%$message%")
            ->orderByRaw('LENGTH(keyword) DESC')
            ->first();

        /**
         * 2️⃣ FALLBACK: MATCH PER KATA
         */
        if (!$faq) {
            $words = array_filter(explode(' ', $message), function ($word) {
                return strlen($word) >= 3; // hindari "di", "ke", "yg"
            });

            if (!empty($words)) {
                $faq = Faq::where('is_active', true)
                    ->where(function ($q) use ($words) {
                        foreach ($words as $word) {
                            $q->orWhere('keyword', 'like', "%$word%");
                        }
                    })
                    ->orderByRaw('LENGTH(keyword) DESC')
                    ->first();
            }
        }

        /**
         * 3️⃣ JIKA BOT MENEMUKAN JAWABAN
         */
        if ($faq) {
            return response()->json([
                'success' => true,
                'source'  => 'bot',
                'reply'   => $faq->answer
            ]);
        }

        /**
         * 4️⃣ JIKA BOT GAGAL → SIMPAN KE CS CHAT
         */
        $chat = CsChat::create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'status'  => 'waiting_cs'
        ]);

        return response()->json([
            'success' => true,
            'source'  => 'cs',
            'reply'   => 'Pesan Anda akan diteruskan ke Customer Service.',
            'chat_id' => $chat->id
        ]);
    }

    /**
     * ===========================
     * WAITING CHAT (KHUSUS CS)
     * ===========================
     */
    public function waitingChats(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'cs') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $chats = CsChat::where('status', 'waiting_cs')
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $chats
        ]);
    }

    /**
     * ===========================
     * CS REPLY CHAT
     * ===========================
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:500'
        ]);

        $user = $request->user();

        if ($user->role !== 'cs') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $chat = CsChat::findOrFail($id);

        $chat->update([
            'reply'  => $request->reply,
            'status' => 'answered'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Balasan terkirim'
        ]);
    }
}
