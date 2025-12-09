<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FormSimController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket' => 'required|string',
            'nama_lengkap' => 'required|string',
            'ttl' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'pekerjaan' => 'required|string',
            'mobil' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'opsi_kredit' => 'nullable|string',
            'harga' => 'nullable|integer',
            'pas_foto' => 'required|image|max:5120',
            'ktp' => 'required|image|max:5120',
        ]);

        // Simpan file ke storage/app/public/...
        $pasFotoPath = $request->file('pas_foto')->store('pas_foto', 'public');
        $ktpPath = $request->file('ktp')->store('ktp', 'public');

        $pasFotoUrl = url('storage/' . $pasFotoPath);
        $ktpUrl = url('storage/' . $ktpPath);

        // Ambil user id jika tersedia (token), else null
        $userId = optional($request->user())->id;

        DB::table('pendaftaran_sim')->insert([
            'user_id' => $userId,
            'paket' => $validated['paket'],

            'nama_lengkap' => $validated['nama_lengkap'],
            'ttl' => $validated['ttl'],
            'alamat' => $validated['alamat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'pekerjaan' => $validated['pekerjaan'],

            'mobil_dipilih' => $validated['mobil'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'opsi_kredit' => $validated['opsi_kredit'] ?? null,

            'pas_foto_url' => $pasFotoUrl,
            'ktp_url' => $ktpUrl,

            'harga' => $validated['harga'] ?? 0,
            'tanggal_daftar' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'status' => true,
            'message' => 'Pendaftaran SIM berhasil disimpan',
            'data' => [
                'pas_foto_url' => $pasFotoUrl,
                'ktp_url' => $ktpUrl
            ]
        ]);

    }
}
