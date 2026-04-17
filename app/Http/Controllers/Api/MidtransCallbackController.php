<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
public function handle(Request $request)
{
    $orderId = $request->order_id;
    $midtransStatus = $request->transaction_status;

    $transaction = Transaction::where('midtrans_order_id', $orderId)->firstOrFail();
    $pendaftaran = Pendaftaran::findOrFail($transaction->pendaftaran_id);

    // ✅ Mapping status
    if (in_array($midtransStatus, ['settlement', 'capture'])) {
        $transaction->transaction_status = 'paid';
        $transaction->paid_at = now();
    } elseif ($midtransStatus === 'pending') {
        $transaction->transaction_status = 'pending';
    } elseif (in_array($midtransStatus, ['expire', 'cancel'])) {
        $transaction->transaction_status = 'expire';
    } else {
        $transaction->transaction_status = 'failed';
    }

    $transaction->save();

    // ======================
    // UPDATE PENDAFTARAN
    // ======================

    if ($transaction->type === 'dp' && $transaction->transaction_status === 'paid') {
        $pendaftaran->status_pembayaran = 'dp';
    }

    if ($transaction->type === 'cicilan' && $transaction->transaction_status === 'paid') {

        $totalCicilan = Transaction::where('pendaftaran_id', $pendaftaran->id)
            ->where('type', 'cicilan')
            ->count();

        $cicilanLunas = Transaction::where('pendaftaran_id', $pendaftaran->id)
            ->where('type', 'cicilan')
            ->where('transaction_status', 'paid')
            ->count();

        if ($cicilanLunas >= $totalCicilan) {
            $pendaftaran->status_pembayaran = 'lunas';
        } else {
            $pendaftaran->status_pembayaran = 'cicilan';
        }
    }

    if ($transaction->type === 'lunas' && $transaction->transaction_status === 'paid') {
        $pendaftaran->status_pembayaran = 'lunas';
    }

    $pendaftaran->save();
\Log::info('MIDTRANS CALLBACK MASUK', $request->all());
    return response()->json(['message' => 'OK']);
}
}