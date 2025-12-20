<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function show(Request $request)
    {
        return view('payment.form', [
            'paket' => $request->paket,
            'harga' => $request->harga,
        ]);
    }
}
