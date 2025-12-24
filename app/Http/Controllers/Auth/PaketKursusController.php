<?php

namespace App\Http\Controllers;

use App\Models\PaketKursus;
use Illuminate\Http\Request;

class PaketKursusController extends Controller
{
public function index()
{
    $paket = PaketKursus::all()->map(function($p){
        return [
            'id' => $p->id,
            'nama' => $p->nama,
            'harga' => $p->harga,
            'tipe' => $p->tipe,
            'image' => $p->image ? asset("storage/paket_kursus/{$p->image}") : null
        ];
    });

    return response()->json($paket);
}

}
