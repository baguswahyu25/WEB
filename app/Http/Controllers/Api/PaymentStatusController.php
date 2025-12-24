<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class PaymentStatusController extends Controller
{
    public function check($pendaftaranId)
    {
        $transaction = Transaction::where('pendaftaran_id', $pendaftaranId)->first();

        if (!$transaction) {
            return response()->json([
                'status' => 'not_found'
            ], 404);
        }

        return response()->json([
            'status' => $transaction->transaction_status // paid | pending | failed
        ]);
    }
}
