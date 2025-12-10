<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;

class FormSimController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $rules = [
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

            'pas_foto' => 'required|file|image|max:5120',
            'ktp' => 'required|file|image|max:5120',
        ];

        try {
            $validated = $request->validate($rules);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }

        try {

            DB::beginTransaction();

            $pasFotoPath = $request->file('pas_foto')->store('form_sim/pas_foto', 'public');
            $ktpPath     = $request->file('ktp')->store('form_sim/ktp', 'public');

            $id = DB::table('pendaftaran_sim')->insertGetId([
                'paket'             => $validated['paket'],
                'nama_lengkap'      => $validated['nama_lengkap'],
                'ttl'               => $validated['ttl'],
                'alamat'            => $validated['alamat'],
                'jenis_kelamin'     => $validated['jenis_kelamin'],
                'pekerjaan'         => $validated['pekerjaan'],
                'mobil_dipilih'     => $validated['mobil'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'opsi_kredit'       => $validated['opsi_kredit'] ?? null,
                'harga'             => $validated['harga'] ?? 0,

                'pas_foto_url'      => $pasFotoPath,
                'ktp_url'           => $ktpPath,

                'tanggal_daftar'    => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'status'  => true,
                'message' => 'Data Form SIM berhasil disimpan',
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
