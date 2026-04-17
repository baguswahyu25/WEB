<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RiwayatPemesananController extends Controller
{
public function index(Request $request)
{
    $user = $request->user();

    $data = Pendaftaran::with('transaction')
        ->where('user_id', $user->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($p) {

            $trx = $p->transaction;

            $image = match ($p->paket) {
                'Paket Manual' => asset('storage/paket_kursus/manual/paket_manual.jpeg'),
                'Paket Automatic' => asset('storage/paket_kursus/automatic/paket_automatic.jpeg'),
                'Paket Manual + SIM' => asset('storage/paket_kursus/manual_sim/paket_manual.jpeg'),
                'Paket Automatic + SIM' => asset('storage/paket_kursus/automatic_sim/paket_automatic.jpeg'),
                default => asset('storage/default.jpeg'),
            };

            // STATUS AMAN
            $status = $this->getStatus($p, $trx);



            return [
                'id' => $p->id,
                'judul' => 'Kursus Mengemudi',
                'paket' => $p->paket,
                'harga' => (int) ($trx?->amount ?? $p->harga),
                'tanggal' => $trx?->paid_at
                    ? $trx->paid_at->format('d-m-Y H:i')
                    : $p->created_at->format('d-m-Y H:i'),
                'image' => $image,
                'status' => $status,
            ];

        });

    return response()->json($data);
}


    private function getStatus($pendaftaran, $trx)
{
    $metode = $pendaftaran->metode_pembayaran;

    if ($metode === 'tunai') {
        return $pendaftaran->status_pembayaran === 'lunas'
            ? 'PAID'
            : 'MENUNGGU PEMBAYARAN';
    }

    if ($metode === 'kredit') {
        return match ($pendaftaran->status_pembayaran) {
            'dp' => 'DP',
            'cicilan' => 'CICILAN',
            'lunas' => 'PAID',
            default => 'MENUNGGU PEMBAYARAN',
        };
    }

    // transfer / midtrans
    return match ($trx?->transaction_status) {
        'settlement', 'capture' => 'PAID',
        'pending' => 'PENDING',
        'expire' => 'EXPIRED',
        'cancel' => 'CANCEL',
        'failed' => 'FAILED',
        default => 'UNPAID',
    };
}
public function show(Request $request, $id)
{
    $user = $request->user();

    $pendaftaran = Pendaftaran::with('transaction')
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->firstOrFail();

   $trx = $pendaftaran->transaction;

$status = $this->getStatus($pendaftaran, $trx);
$metode = $pendaftaran->metode_pembayaran;

return response()->json([
    'id' => $pendaftaran->id,
    'judul' => 'Kursus Mengemudi',
    'paket' => $pendaftaran->paket,
    'harga' => (int) ($trx?->amount ?? $pendaftaran->harga),
    'tanggal' => $trx?->paid_at?->format('d-m-Y H:i') 
        ?? $pendaftaran->created_at->format('d-m-Y H:i'),
    'status' => $status,
    'metode_pembayaran' => $metode,
    'order_id' => $trx?->midtrans_order_id ?? '-',
]);

}

}
