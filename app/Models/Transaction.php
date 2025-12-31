<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
protected $fillable = [
 'pendaftaran_id',
 'midtrans_order_id',
 'amount',
 'payment_method',
 'transaction_token',
 'transaction_status',
 'paid_at',
 'type',
 'cicilan_ke',
 'total_cicilan',
 'jatuh_tempo',
];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
    /**
     * Relasi: Satu Transaksi dimiliki oleh satu Pendaftaran
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
