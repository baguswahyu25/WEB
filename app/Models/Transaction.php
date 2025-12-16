<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;

class Transaction extends Model
{
    protected $fillable = [
        'pendaftaran_id', 
        'midtrans_order_id', 
        'amount', 
        'payment_method', 
        'transaction_status',
        'paid_at'
    ];
    
    /**
     * Relasi: Satu Transaksi dimiliki oleh satu Pendaftaran.
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}