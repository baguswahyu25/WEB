<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        // ===============================
        // 1. Konfigurasi Midtrans
        // ===============================
        \Midtrans\Config::$serverKey     = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = true;
        \Midtrans\Config::$is3ds         = true;

        if ($request->header('Midtrans-Dummy-Test') === 'true') {
    $orderId           = $request->input('order_id');
    $transactionStatus = $request->input('transaction_status');
    $paymentType       = $request->input('payment_type');
} else {
    $notif = new \Midtrans\Notification();
    $orderId           = $notif->order_id;
    $transactionStatus = $notif->transaction_status;
    $paymentType       = $notif->payment_type ?? null;
    $fraudStatus       = $notif->fraud_status ?? null;
}


        try {
            // ===============================
            // 2. Ambil notifikasi resmi Midtrans
            // ===============================
            $notif = new Notification();

            $orderId           = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus       = $notif->fraud_status ?? null;
            $paymentType       = $notif->payment_type ?? null;

            if (!$orderId || !$transactionStatus) {
                Log::error('Midtrans: order_id / status kosong', (array) $notif);
                return response()->json(['message' => 'Invalid payload'], 400);
            }

            // ===============================
            // 3. Cari transaksi
            // ===============================
            $transaction = Transaction::where('midtrans_order_id', $orderId)->first();

            if (!$transaction) {
                Log::error("Midtrans: Transaksi tidak ditemukan: {$orderId}");
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // ===============================
            // 4. Mapping STATUS FINAL (SEPAKAT)
            // ===============================
            $finalStatus = 'pending';

            if ($transactionStatus === 'capture') {
                $finalStatus = ($fraudStatus === 'accept') ? 'paid' : 'failed';
            } elseif ($transactionStatus === 'settlement') {
                $finalStatus = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'expire', 'deny'])) {
                $finalStatus = 'failed';
            }

            // ===============================
            // 5. Update database (atomic)
            // ===============================
            DB::transaction(function () use ($transaction, $finalStatus, $paymentType) {

                if ($transaction->transaction_status === $finalStatus) {
                    return; // Tidak update jika sama
                }

                $transaction->update([
                    'transaction_status' => $finalStatus,
                    'payment_method'     => $paymentType,
                    'paid_at'            => $finalStatus === 'paid' ? now() : null,
                ]);

                // ===============================
                // 6. Efek ke PENDAFTARAN
                // ===============================
                if ($transaction->pendaftaran) {
                    if ($finalStatus === 'paid') {
                        Log::info("PENDAFTARAN {$transaction->pendaftaran->id} → PAID");
                        // contoh:
                        // $transaction->pendaftaran->update(['status' => 'aktif']);
                    }

                    if ($finalStatus === 'failed') {
                        Log::warning("PENDAFTARAN {$transaction->pendaftaran->id} → FAILED");
                    }
                }
            });

            return response()->json(['message' => 'OK'], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans ERROR: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
