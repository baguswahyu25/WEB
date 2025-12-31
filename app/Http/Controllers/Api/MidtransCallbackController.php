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

    // ✅ Update status transaksi
    if (in_array($midtransStatus, ['settlement', 'capture'])) {
        $transaction->transaction_status = 'settlement';
    } elseif ($midtransStatus === 'pending') {
        $transaction->transaction_status = 'pending';
    } else {
        $transaction->transaction_status = 'failed';
    }
    $transaction->save();

    // ======================
    // UPDATE STATUS PENDAFTARAN
    // ======================

    // DP
    if ($transaction->type === 'dp' && $transaction->transaction_status === 'settlement') {
        $pendaftaran->status_pembayaran = 'dp';
    }

    // CICILAN
    if ($transaction->type === 'cicilan' && $transaction->transaction_status === 'settlement') {

        $totalCicilan = Transaction::where('pendaftaran_id', $pendaftaran->id)
            ->where('type', 'cicilan')
            ->count();

        $cicilanLunas = Transaction::where('pendaftaran_id', $pendaftaran->id)
            ->where('type', 'cicilan')
            ->where('transaction_status', 'settlement')
            ->count();

        if ($cicilanLunas >= $totalCicilan) {
            $pendaftaran->status_pembayaran = 'lunas';
        } else {
            $pendaftaran->status_pembayaran = 'cicilan';
        }
    }

    // LUNAS SEKALIGUS
    if ($transaction->type === 'lunas' && $transaction->transaction_status === 'settlement') {
        $pendaftaran->status_pembayaran = 'lunas';
    }

    $pendaftaran->save();

    return response()->json(['message' => 'OK']);
}
}