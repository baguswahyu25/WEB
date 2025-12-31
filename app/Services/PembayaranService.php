<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Models\Transaction;
use Illuminate\Support\Str;

class PembayaranService
{
     public function buatLunas(Pendaftaran $pendaftaran): Transaction
{
    return Transaction::create([
        'pendaftaran_id' => $pendaftaran->id,
        'midtrans_order_id' => 'LUNAS-' . Str::uuid(), // ✅ WAJIB
        'amount' => $pendaftaran->harga,
        'type' => 'lunas',
        'transaction_status' => 'pending',
        'payment_method' => 'transfer_bank',
    ]);
}
    public function buatDP(Pendaftaran $pendaftaran)
    {
        $total = $pendaftaran->harga;

        $dp = intval($total * 0.5);

        return Transaction::create([
            'pendaftaran_id' => $pendaftaran->id,
            'midtrans_order_id' => 'DP-' . Str::uuid(),
            'amount' => $dp,
            'type' => 'dp',
            'transaction_status' => 'pending',
        ]);
    }

    public function buatCicilan(Pendaftaran $pendaftaran, int $jumlahCicilan)
    {
            $total = $pendaftaran->harga;
            $dp = intval($total * 0.5);
            $sisa = $total - $dp;

            $perCicilan = intdiv($sisa, $jumlahCicilan);
            $sisaAkhir  = $sisa - ($perCicilan * $jumlahCicilan);


        for ($i = 1; $i <= $jumlahCicilan; $i++) {

    $amount = $perCicilan;

    if ($i === $jumlahCicilan) {
        $amount += $sisaAkhir;
    }

    Transaction::create([
        'pendaftaran_id' => $pendaftaran->id,
        'midtrans_order_id' => 'CICILAN-' . $i . '-' . Str::uuid(),
        'amount' => $amount,
        'type' => 'cicilan',
        'cicilan_ke' => $i,
        'total_cicilan' => $jumlahCicilan,
        'transaction_status' => 'pending',
    ]);
}

    }
}
