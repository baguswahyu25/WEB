<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class RiwayatCicilanController extends Controller
{
    public function index($pendaftaranId)
    {
        $pendaftaran = Pendaftaran::with(['transactions' => function ($q) {
            $q->orderByRaw("
                CASE 
                    WHEN type = 'dp' THEN 1
                    WHEN type = 'cicilan' THEN 2
                    ELSE 3
                END
            ")->orderBy('cicilan_ke');
        }])->findOrFail($pendaftaranId);

$data = $pendaftaran->transactions->map(function ($trx) {
    return [
        'id' => $trx->id,
        'type' => $trx->type,
        'label' => $trx->type === 'dp'
            ? 'DP'
            : 'Cicilan ' . $trx->cicilan_ke,
        'amount' => (int) $trx->amount,
        'status' => $trx->transaction_status,
        'tanggal' => optional($trx->updated_at)->format('d-m-Y H:i'),
    ];
})->values();

        return response()->json([
            'status_pembayaran' => $pendaftaran->status_pembayaran,
            'items' => $data
        ]);
    }
}
