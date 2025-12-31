<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function next($pendaftaranId)
{
    $pendaftaran = Pendaftaran::findOrFail($pendaftaranId);

    // 1. DP harus lunas
    $dp = Transaction::where('pendaftaran_id', $pendaftaran->id)
        ->where('type', 'dp')
        ->where('transaction_status', 'settlement')
        ->first();

    if (!$dp) {
        return response()->json(['message' => 'DP belum lunas'], 403);
    }

    // 2. Tidak boleh ada cicilan pending
    $pending = Transaction::where('pendaftaran_id', $pendaftaran->id)
        ->where('type', 'cicilan')
        ->where('transaction_status', 'pending')
        ->exists();

    if ($pending) {
        return response()->json(['message' => 'Masih ada cicilan aktif'], 409);
    }

    // 3. Ambil cicilan berikutnya
    $transaction = Transaction::where('pendaftaran_id', $pendaftaranId)
        ->where('transaction_status', 'pending')
        ->orderBy('cicilan_ke')
        ->first();

    if (!$transaction) {
        return response()->json(['message' => 'Tidak ada transaksi aktif'], 404);
    }
if ($existingPendingTransaction) {
    return response()->json([
        'error' => 'Masih ada cicilan pending'
    ], 422);
}
    return response()->json([
        'transaction_id' => $transaction->id,
        'type' => $transaction->type,
        'amount' => (int) $transaction->amount,
        'cicilan_ke' => $transaction->cicilan_ke,
    ]);
}
public function retryPayment($transactionId)
{
    $transaction = Transaction::findOrFail($transactionId);

    // 🔒 PROTEKSI
    if ($transaction->status === 'PAID') {
        return response()->json([
            'message' => 'Transaksi sudah lunas'
        ], 400);
    }

    // 🔧 Midtrans config
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => $transaction->order_id,
            'gross_amount' => $transaction->amount,
        ],
        'customer_details' => [
            'first_name' => $transaction->user->name,
            'email' => $transaction->user->email,
        ],
        'enabled_payments' => ['bank_transfer', 'qris'], // QRIS OK
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // simpan token baru
    $transaction->snap_token = $snapToken;
    $transaction->save();

    return response()->json([
        'snap_token' => $snapToken
    ]);
}

}
