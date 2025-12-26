<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pendaftaran;

class RiwayatPemesananController extends Controller
{
public function index(Request $request)
{
    $user = $request->user();

    $data = Pendaftaran::with('transaction')
        ->where('user_id', $user->id)
        ->whereHas('transaction', function ($q) {
            $q->whereIn('transaction_status', [
                'pending','paid','failed','expire','settlement','cancel'
            ]);
        })
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($p) {

            $trx = $p->transaction;

            $image = match ($p->paket) {
                'Paket Manual' => asset('storage/paket_kursus/manual/paket_manual.jpg'),
                'Paket Automatic' => asset('storage/paket_kursus/automatic/paket_automatic.jpg'),
                'Paket Manual + SIM' => asset('storage/paket_kursus/manual_sim/paket_manual.jpg'),
                'Paket Automatic + SIM' => asset('storage/paket_kursus/automatic_sim/paket_automatic.jpg'),
                default => asset('storage/default.jpg'),
            };

            return [
                'id' => $p->id,
                'judul' => 'Kursus Mengemudi',
                'paket' => $p->paket,
                'harga' => (int) ($trx?->amount ?? 0),
                'tanggal' => $trx?->paid_at instanceof \Carbon\Carbon
                    ? $trx->paid_at->format('d-m-Y H:i')
                    : $p->created_at->format('d-m-Y H:i'),
                'image' => $image,
                'status' => $trx->transaction_status === 'settlement'
    ? 'PAID'
    : strtoupper($trx->transaction_status),
            ];
        });

    return response()->json($data);
}
public function show(Request $request, $id)
{
    $user = $request->user();

    $pendaftaran = Pendaftaran::with('transaction')
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->firstOrFail();

    $trx = $pendaftaran->transaction;

    return response()->json([
        'id' => $pendaftaran->id,
        'judul' => 'Kursus Mengemudi',
        'paket' => $pendaftaran->paket,
        'harga' => $trx?->amount ?? 0,
        'tanggal' => optional($trx?->paid_at)->format('d-m-Y H:i'),
        'status' => $trx->transaction_status === 'settlement'
    ? 'PAID'
    : strtoupper($trx->transaction_status),
        'order_id' => $trx?->midtrans_order_id,
        'metode_pembayaran' => $trx?->payment_method,
        'payment_status' => strtoupper($trx?->transaction_status),
    ]);
}
}
