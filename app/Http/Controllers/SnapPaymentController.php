<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;

class SnapPaymentController extends Controller
{
    public function show($pendaftaran_id)
    {
        $pendaftaran = Pendaftaran::with('transaction')->findOrFail($pendaftaran_id);
        $transaction = $pendaftaran->transaction;

        if (!$transaction) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        if ($transaction->transaction_status === 'paid') {
            return redirect()->route('dashboard')
                ->with('success', 'Pembayaran sudah lunas');
        }

        // 🔑 KONFIGURASI MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 🔁 BUAT SNAP TOKEN JIKA BELUM ADA
        if (!$transaction->transaction_token) {

            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->midtrans_order_id,
                    'gross_amount' => (int) $transaction->amount,
                ],
                'customer_details' => [
                    'first_name' => $pendaftaran->nama_lengkap,
                    'email' => auth()->user()->email ?? 'guest@email.com',
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // SIMPAN KE DB
            $transaction->update([
                'transaction_token' => $snapToken,
                'payment_method' => 'midtrans',
            ]);
        }

        return view('payment.snap', [
            'snapToken' => $transaction->transaction_token,
            'clientKey' => config('midtrans.client_key'),
            'pendaftaran' => $pendaftaran,
            'transaction' => $transaction, 
        ]);
    }
}
