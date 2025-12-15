<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Exception;

class FormPendaftaranController extends Controller
{
    public function store(Request $request)
    {
        // VALIDASI DASAR
        $rules = [
            'paket'             => 'required|string',
            'nama_lengkap'      => 'required|string',

            'tempat_lahir'      => 'required|string',
            'tanggal_lahir' => 'required|date_format:Y-m-d',

            'alamat'            => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',

            'pekerjaan'         => 'required|string',
            'mobil_dipilih'             => 'required|string',

            'metode_pembayaran' => 'required|string',
            'opsi_kredit'       => 'nullable|string',

            'harga'             => 'required|integer',

            // menentukan sim / non sim
            'tipe_pendaftaran'  => 'required|in:sim,non_sim',
        ];

        // Jika SIM → file wajib
        if ($request->tipe_pendaftaran === 'sim') {
            $rules['pas_foto'] = 'required|file|image|max:5120';
            $rules['ktp']      = 'required|file|image|max:5120';
        }

        // Jalankan validasi
        try {
            $validated = $request->validate($rules);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $e->errors()
            ], 422);
        }

        try {

            DB::beginTransaction();

            // Upload file hanya SIM
            $pasFotoPath = null;
            $ktpPath     = null;

            if ($validated['tipe_pendaftaran'] === 'sim') {
                $pasFotoPath = $request->file('pas_foto')->store('pendaftaran/pas_foto', 'public');
                $ktpPath     = $request->file('ktp')->store('pendaftaran/ktp', 'public');
            }

            // Insert data
            $id = DB::table('pendaftaran')->insertGetId([
                'user_id'          => $request->user()->id ?? null,
                'paket'            => $validated['paket'],

                'nama_lengkap'     => $validated['nama_lengkap'],
                'tempat_lahir'     => $validated['tempat_lahir'],
                'tanggal_lahir'    => $validated['tanggal_lahir'],

                'alamat'           => $validated['alamat'],
                'jenis_kelamin'    => $validated['jenis_kelamin'],
                'pekerjaan'        => $validated['pekerjaan'],

                'mobil_dipilih'    => $validated['mobil_dipilih'],
                'metode_pembayaran'=> $validated['metode_pembayaran'],
                'opsi_kredit'      => $validated['opsi_kredit'] ?? null,

                'harga'            => $validated['harga'],

                'pas_foto_url'     => $pasFotoPath,
                'ktp_url'          => $ktpPath,

                'tipe_pendaftaran' => $validated['tipe_pendaftaran'],

                'tanggal_daftar'   => now(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'status'  => true,
                'message' => 'Pendaftaran berhasil disimpan',
                'id'      => $id
            ]);

        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'status'  => false,
                'message' => 'Terjadi kesalahan server',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
