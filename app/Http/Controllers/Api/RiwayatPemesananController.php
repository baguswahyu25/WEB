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
                'Paket Manual' => asset('storage/paket_kursus/manual/paket_manual.jpg'),
                'Paket Automatic' => asset('storage/paket_kursus/automatic/paket_automatic.jpg'),
                'Paket Manual + SIM' => asset('storage/paket_kursus/manual_sim/paket_manual.jpg'),
                'Paket Automatic + SIM' => asset('storage/paket_kursus/automatic_sim/paket_automatic.jpg'),
                default => asset('storage/default.jpg'),
            };

            // STATUS AMAN
            $status = $p->status_pembayaran ?? 'UNPAID';
            switch ($status) {
                case 'belum_bayar':
                    $label = 'Belum Bayar';
                    break;
                case 'dp':
                    $label = 'DP Terbayar';
                    break;
                case 'cicilan':
                    $label = 'Dalam Cicilan';
                    break;
                case 'lunas':
                    $label = 'Lunas';
                    break;
            }



            return [
                'id' => $p->id,
                'judul' => 'Kursus Mengemudi',
                'paket' => $p->paket,
                'harga' => (int) ($trx?->amount ?? 0),
                'tanggal' => $trx?->paid_at
                    ? $trx->paid_at->format('d-m-Y H:i')
                    : $p->created_at->format('d-m-Y H:i'),
                'image' => $image,
                'status' => $status,
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

    $status = match ($trx?->transaction_status) {
        'settlement' => 'PAID',
        'pending' => 'PENDING',
        'expire' => 'EXPIRED',
        'cancel' => 'CANCEL',
        'failed' => 'FAILED',
        default => 'UNPAID',
    };

    return response()->json([
        'id' => $pendaftaran->id,
        'judul' => 'Kursus Mengemudi',
        'paket' => $pendaftaran->paket,
        'harga' => (int) ($trx?->amount ?? 0),
        'tanggal' => $trx?->paid_at?->format('d-m-Y H:i'),
        'status' => $status,
        'order_id' => $trx?->midtrans_order_id,
        'metode_pembayaran' => $trx?->payment_method ?? '-',
        'payment_status' => $status,
    ]);
}

}
