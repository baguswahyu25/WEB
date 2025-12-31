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

        try {
            $serverKey = config('midtrans.server_key');

            $expectedSignature = hash(
                'sha512',
                $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
            );

            if ($request->signature_key !== $expectedSignature) {
                Log::warning('Invalid Midtrans signature', $request->all());
                return response()->json(['message' => 'Invalid signature'], 403);
            }
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
            } elseif (in_array($transactionStatus, ['cancel','expire','deny'])) {
                $finalStatus = 'failed';
            }

            
            // ===============================
            // 5. Update database (atomic)
            // ===============================
            DB::transaction(function () use ($transaction, $finalStatus, $paymentType) {

                if ($transaction->transaction_status === $finalStatus) {
                    return; // Tidak update jika sama
                }   
                $updateData = [
                    'transaction_status' => $finalStatus,
                    'paid_at' => $finalStatus === 'paid' ? now() : null,
                ];

                if ($paymentType) $updateData['payment_method'] = $paymentType;

                $transaction->update($updateData);

                // ===============================
                // 6. Efek ke PENDAFTARAN
                // ===============================
                if ($transaction->pendaftaran) {
                    if ($finalStatus === 'paid') {      
                        if ($transaction->type === 'dp') {
                            $transaction->pendaftaran->update([
                                'status_pembayaran' => 'dp'
                            ]);
                        }

                        if ($transaction->type === 'cicilan') {

                            $totalPaid = Transaction::where('pendaftaran_id', $transaction->pendaftaran_id)
                                ->where('transaction_status', 'paid')
                                ->sum('amount');

                            if ($totalPaid >= $transaction->pendaftaran->harga) {
                                $transaction->pendaftaran->update([
                                    'status_pembayaran' => 'lunas'
                                ]); 
                            } else {
                                $transaction->pendaftaran->update([
                                    'status_pembayaran' => 'cicilan'
                                ]);
                            }
                        }

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
