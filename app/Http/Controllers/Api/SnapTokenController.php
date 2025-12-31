<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class SnapTokenController extends Controller
{
   public function generate(Request $request)
{
    $request->validate([
        'transaction_id' => 'required|exists:transactions,id',
        'metode' => 'required|in:transfer_bank,kredit',
    ]);
$transaction = Transaction::with('pendaftaran')
    ->findOrFail($request->transaction_id);

if ($transaction->transaction_status !== 'pending') {
    abort(403, 'Transaksi tidak valid');
}
    // ✅ KONFIGURASI MIDTRANS

    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = false;

    // ✅ MIDTRANS HANYA ALAT BAYAR
    $enabledPayments = ['bank_transfer', 'qris'];

    $params = [
        'transaction_details' => [
            'order_id' => $transaction->midtrans_order_id,
            'gross_amount' => (int) $transaction->amount,
        ],
        'customer_details' => [
            'first_name' => preg_replace('/[^a-zA-Z ]/', '', $transaction->pendaftaran->nama_lengkap),
            'email' => 'user'.$transaction->pendaftaran_id.'@example.com',
        ],
        'enabled_payments' => $enabledPayments,
    ];

    $snapToken = Snap::getSnapToken($params);

    $transaction->update([
        'transaction_token' => $snapToken,
        'payment_method' => $request->metode, // transfer_bank / kredit
    ]);

    return response()->json([
        'snap_token' => $snapToken,
        'order_id' => $transaction->midtrans_order_id,
        'amount' => (int) $transaction->amount,
    ]);
}


}
