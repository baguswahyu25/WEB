<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'ttl' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pekerjaan' => 'required|string',
            'mobil' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'opsi_kredit' => 'nullable|string',

            // ⬇️ Tambahkan ini
            'paket_kursus' => 'required|string',
        ]);

        DB::table('pendaftaran')->insert([
            'user_id' => $request->user()->id,
            'nama_lengkap' => $validated['nama_lengkap'],
            'ttl' => $validated['ttl'],
            'alamat' => $validated['alamat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'pekerjaan' => $validated['pekerjaan'],
            'mobil' => $validated['mobil'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'opsi_kredit' => $validated['opsi_kredit'] ?? null,

            // ⬇️ Simpan paket kursus
            'paket_kursus' => $validated['paket_kursus'],

            'created_at' => now(),
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ], 200);
    }
}
