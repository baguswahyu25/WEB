<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use App\Models\Pendaftaran;
use App\Models\Transaction;
use App\Models\PaketKursus; // ✅ WAJIB
use Exception;

class FormPendaftaranController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'paket' => 'required|exists:paket_kursus,tipe',
        'nama_lengkap'      => 'required|string',
        'tempat_lahir'      => 'required|string',
        'tanggal_lahir'     => 'required|date_format:Y-m-d',
        'alamat'            => 'required|string',
        'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
        'pekerjaan'         => 'required|string',
        'mobil_dipilih'     => 'required|string',
        'metode_pembayaran' => 'required|string',
        'opsi_kredit'       => 'nullable|string',
        'tipe_pendaftaran'  => 'required|in:sim,non_sim',
    ]);

    $paket = PaketKursus::where('tipe', $validated['paket'])->firstOrFail();

    DB::beginTransaction();
    try {

        // 1️⃣ BUAT PENDAFTARAN
        $pendaftaran = Pendaftaran::create([
            'user_id'          => $request->user()->id ?? null,
            'paket'            => $paket->nama,
            'harga'            => $paket->harga,
            'total_pertemuan'  => $paket->total_pertemuan,
            'sisa_pertemuan'   => $paket->total_pertemuan,
            'nama_lengkap'     => $validated['nama_lengkap'],
            'tempat_lahir'     => $validated['tempat_lahir'],
            'tanggal_lahir'    => $validated['tanggal_lahir'],
            'alamat'           => $validated['alamat'],
            'jenis_kelamin'    => $validated['jenis_kelamin'],
            'pekerjaan'        => $validated['pekerjaan'],
            'mobil_dipilih'    => $validated['mobil_dipilih'],
            'metode_pembayaran'=> $validated['metode_pembayaran'],
            'opsi_kredit'      => $validated['opsi_kredit'] ?? null,
            'tipe_pendaftaran' => $validated['tipe_pendaftaran'],
            'tanggal_daftar'   => now(),
        ]);

        // 2️⃣ TRANSAKSI VIA SERVICE
        $service = app(\App\Services\PembayaranService::class);

        if ($validated['metode_pembayaran'] === 'kredit') {
            $transaction = $service->buatDP($pendaftaran);
            $service->buatCicilan($pendaftaran, 8);
        } else {
            $transaction = $service->buatLunas($pendaftaran);
        }

        DB::commit();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'pendaftaran_id' => $pendaftaran->id,
                'transaction_id' => $transaction->id
            ]);
        }

        // WEB
        return redirect()
            ->route('bayar.show', $pendaftaran->id);

    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function show($id)
{
    $pendaftaran = Pendaftaran::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if (!$pendaftaran) {
        return response()->json([
            'message' => 'Data pendaftaran tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'paket_nama' => $pendaftaran->paket, // STRING
        'total'     => $pendaftaran->harga,
        'metode'    => $pendaftaran->metode_pembayaran,
        'tanggal'   => $pendaftaran->created_at?->format('Y-m-d'),
    ]);
}
public function aktif(Request $request)
{
    $pendaftaran = Pendaftaran::with('transactions')
        ->where('user_id', $request->user()->id)
        ->where('status_pendaftaran', 'aktif')
        ->latest()
        ->first();

    if (!$pendaftaran) {
        return response()->json([
            'message' => 'Tidak ada pendaftaran aktif'
        ], 404);
    }
    $lastTransaction = $pendaftaran->transactions()->latest()->first();
    return response()->json([
        'id' => $pendaftaran->id,
        'status_pendaftaran' => $pendaftaran->status_pendaftaran,
        'total_pertemuan' => $pendaftaran->total_pertemuan,
        'sisa_pertemuan' => $pendaftaran->sisa_pertemuan,
        'transaction' => $lastTransaction ? [
        'transaction_status' => $lastTransaction->transaction_status,
        'amount' => $lastTransaction->amount
    ] : null
    ]);
}


}
