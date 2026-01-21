<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class BayarController extends Controller
{
    public function show($pendaftaranId)
    {
        $pendaftaran = Pendaftaran::where('id', $pendaftaranId)
        ->where('user_id', auth()->id())
        ->firstOrFail();


        return view('payment.form', compact('pendaftaran'));

    }
}
