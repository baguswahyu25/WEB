<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class RiwayatPemesananController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $data = Transaction::with('pendaftaran')
            ->where('user_id', $user->id)
            ->where('transaction_status', 'paid')
            ->orderByDesc('paid_at')
            ->get()
            ->map(function ($trx) {
                return [
                    'id' => $trx->id,
                    'judul' => 'Kursus Mengemudi',
                    'paket' => $trx->pendaftaran->paket,
                    'harga' => $trx->gross_amount,
                    'tanggal' => $trx->paid_at->format('d-m-Y H:i'),
                ];
            });

        return response()->json($data);
    }

    public function show($id, Request $request)
    {
        $trx = Transaction::with('pendaftaran')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json([
            'judul' => 'Kursus Mengemudi',
            'paket' => $trx->pendaftaran->paket,
            'harga' => $trx->gross_amount,
            'tanggal' => $trx->paid_at->format('d-m-Y H:i'),
            'status' => $trx->transaction_status
        ]);
    }
}
