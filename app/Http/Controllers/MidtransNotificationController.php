<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\Transaction;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        // 1. Inisialisasi Midtrans Config
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 2. Ambil payload raw
        $payload = $request->all();

        if (empty($payload)) {
            Log::error('Midtrans notification payload kosong');
            return response()->json(['message' => 'Payload kosong'], 400);
        }

        // 3. Ambil key pertama (mengatasi sandbox numeric key)
        $firstKey = array_key_first($payload);
        $data = $payload[$firstKey] ?? $payload; // fallback jika payload langsung associative

        // 4. Ambil order_id dan status dengan aman
        $orderId = $data['order_id'] ?? $data['transaction_id'] ?? $firstKey;
        $transactionStatus = $data['transaction_status'] ?? $data['status'] ?? null;
        $fraudStatus = $data['fraud_status'] ?? null;
        $paymentType = $data['payment_type'] ?? null;

        if (!$orderId || !$transactionStatus) {
            Log::error('Order ID atau transaction status tidak ditemukan', $payload);
            return response()->json(['message' => 'Order ID atau status tidak ditemukan'], 400);
        }

        // 5. Cari transaksi
        $transaction = Transaction::where('midtrans_order_id', $orderId)->first();

        if (!$transaction) {
            Log::error("Transaction dengan Order ID $orderId tidak ditemukan");
            return response()->json(['message' => 'Order ID not found'], 404);
        }

        // 6. Update status dalam DB
        DB::transaction(function () use ($transaction, $transactionStatus, $fraudStatus, $paymentType) {
            
            // Tentukan status baru
            $newStatus = $transactionStatus; // default
            if ($transactionStatus === 'capture') {
                $newStatus = ($fraudStatus === 'accept') ? 'paid' : 'failed';
            } elseif ($transactionStatus === 'settlement') {
                $newStatus = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'expire', 'deny'])) {
                $newStatus = 'failed';
            }

            // Update transaksi jika berbeda
            if ($transaction->transaction_status !== $newStatus) {
                $transaction->update([
                    'transaction_status' => $newStatus,
                    'payment_method' => $paymentType,
                    'paid_at' => ($newStatus === 'paid') ? now() : null,
                ]);

                // Update pendaftaran jika ada relasi
                $pendaftaran = $transaction->pendaftaran; // pastikan relasi Transaction->pendaftaran() ada

                if ($pendaftaran) {
                    if ($newStatus === 'paid') {
                        Log::info("Pendaftaran ID {$pendaftaran->id} LUNAS.");
                        // Contoh: $pendaftaran->update(['status_pendaftaran' => 'confirmed']);
                    } elseif ($newStatus === 'failed') {
                        Log::warning("Pendaftaran ID {$pendaftaran->id} GAGAL/KADALUARSA.");
                        // Contoh: $pendaftaran->update(['status_pendaftaran' => 'expired']);
                    }
                }
            }
        });

        return response()->json(['message' => 'Notification processed successfully'], 200);
    }
}
