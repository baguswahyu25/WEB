<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Pendaftaran;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Pendaftaran $pendaftaran)
    {
        $params = [
            'transaction_details' => [
                'order_id' => 'REG-' . $pendaftaran->id . '-' . time(),
                'gross_amount' => (int) $pendaftaran->harga,
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->nama_lengkap,
            ],
            'item_details' => [[
                'id' => $pendaftaran->id,
                'price' => (int) $pendaftaran->harga,
                'quantity' => 1,
                'name' => 'Pendaftaran ' . $pendaftaran->paket,
            ]]
        ];

        return Snap::getSnapToken($params);
    }
}
