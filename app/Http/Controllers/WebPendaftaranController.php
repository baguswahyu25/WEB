<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;
use App\Models\Pendaftaran;

class WebPendaftaranController extends Controller
{
    public function showForm(Request $request)
    {
        $paket = $request->query('paket') ?? 'Tidak diketahui';
        $harga = $request->query('harga') ?? 0;

        return view('bayar', compact('paket', 'harga'));
    }

    public function initPayment(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pekerjaan' => 'required|string',
            'mobil_dipilih' => 'required|string',
            'paket' => 'required|string',
            'harga' => 'required|integer',
        ]);

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Fix CURL SSL di development lokal
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
        ];

        $orderId = 'ORDER-' . uniqid();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama_lengkap,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $transaction = Transaction::create([
                'midtrans_order_id' => $orderId,
                'amount' => $request->harga,
                'payment_method' => 'card',
                'transaction_token' => $snapToken,
                'transaction_status' => 'pending',
            ]);

            return response()->json([
                'snapToken' => $snapToken,
                'transaction_id' => $transaction->id
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

 public function handleCallback(Request $request)
{
    $payload = $request->all();

    // Ambil key pertama dari array payload
    $firstKey = array_key_first($payload);
    if (!$firstKey) {
        return response()->json(['error' => 'Payload kosong'], 400);
    }

    $data = $payload[$firstKey];

    $orderId = $data['order_id'] ?? $data['transaction_id'] ?? $firstKey;
    $transactionStatus = $data['transaction_status'] ?? $data['status'] ?? null;

    if (!$transactionStatus) {
        return response()->json(['error' => 'Transaction status tidak ditemukan'], 400);
    }

    $transaction = Transaction::where('midtrans_order_id', $orderId)->first();

    if (!$transaction) return response()->json(['error' => 'Transaction not found'], 404);

    $transaction->transaction_status = $transactionStatus;

    if (in_array($transactionStatus, ['settlement', 'capture', 'success'])) {
        Pendaftaran::create([
            'nama_lengkap' => $data['customer_name'] ?? 'Guest',
            'paket' => $data['paket'] ?? 'Tidak diketahui',
            'harga' => $transaction->amount,
            'tanggal_daftar' => now(),
        ]);

        $transaction->paid_at = now();
    }

    $transaction->save();

    return response()->json(['status' => 'ok']);
}
}