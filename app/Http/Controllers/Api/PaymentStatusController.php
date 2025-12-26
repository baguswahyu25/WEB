<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Pendaftaran;

class PaymentStatusController extends Controller
{
public function check($pendaftaranId)
{
    $transaction = Transaction::with('pendaftaran')
        ->where('pendaftaran_id', $pendaftaranId)
        ->first();

    if (!$transaction) {
        return response()->json([
            'status' => 'not_found'
        ], 404);
    }

return response()->json([
    'status'      => $transaction->transaction_status, // paid / settlement
    'paket_nama'  => optional($transaction->pendaftaran)->paket,
    'metode'      => $transaction->payment_method,
    'total'       => $transaction->amount // ✅ FIX DI SINI
]);
}
}
