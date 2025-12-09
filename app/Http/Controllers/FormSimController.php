<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormSimController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'paket' => 'required',
            'ktp' => 'required|image',
            'kk' => 'required|image',
        ]);

        // Upload ke storage/app/ktp | kk
        $ktpPath = $request->file('ktp')->store('ktp');
        $kkPath = $request->file('kk')->store('kk');

        // Buat URL public untuk admin
        $ktpUrl = url('storage/' . $ktpPath);
        $kkUrl = url('storage/' . $kkPath);

        // Simpan ke database
        DB::table('pendaftaran_sim')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'mobil' => $request->mobil,
            'metode_pembayaran' => $request->metode_pembayaran,
            'opsi_kredit' => $request->opsi_kredit,
            'paket_kursus' => $request->paket,
            'ktp_url' => $ktpUrl,
            'kk_url' => $kkUrl,
            'harga' => $request->harga ?? 0,
            'tanggal_daftar' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran SIM berhasil disimpan',
            'ktp_url' => $ktpUrl,
            'kk_url' => $kkUrl
        ]);
    }
}
