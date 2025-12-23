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
        'pendaftaran_id' => 'required|integer',
        'metode' => 'required|string'
    ]);

    $transaction = Transaction::where(
        'pendaftaran_id',
        $request->pendaftaran_id
    )->firstOrFail();

    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $enabledPayments = [];

    switch ($request->metode) {
        case 'transfer_bank':
            $enabledPayments = ['bank_transfer'];
            break;

        case 'kredit':
            $enabledPayments = ['credit_card'];
            break;

        default:
            return response()->json([
                'message' => 'Metode tidak valid'
            ], 400);
    }

    $snapToken = Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => $transaction->midtrans_order_id,
            'gross_amount' => (int) $transaction->amount,
        ],
        'customer_details' => [
            'first_name' => $transaction->pendaftaran->nama_lengkap ?? 'User',
            'email' => $transaction->pendaftaran->email ?? 'user@example.com',
        ],
        'enabled_payments' => $enabledPayments,
    ]);

    $transaction->update([
        'transaction_token' => $snapToken,
        'payment_method' => $request->metode,
    ]);

    return response()->json([
        'snap_token' => $snapToken,
        'order_id' => $transaction->midtrans_order_id,
        'amount' => $transaction->amount,
    ]);
}

}
