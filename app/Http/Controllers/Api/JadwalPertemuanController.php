<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPertemuan;
use App\Models\Pendaftaran;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class JadwalPertemuanController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'pendaftaran_id' => 'required|exists:pendaftaran,id',
        'pertemuan_ke'   => 'required|integer|min:1',
        'tanggal'        => 'required|date',
        'jam' => 'required|date_format:H:i'
    ]);

    $pendaftaran = Pendaftaran::findOrFail($request->pendaftaran_id);

    if ($request->pertemuan_ke > $pendaftaran->total_pertemuan) {
        return response()->json([
            'message' => 'Pertemuan melebihi total pertemuan paket'
        ], 422);
    }

    if ($pendaftaran->sisa_pertemuan <= 0) {
        return response()->json([
            'message' => 'Sisa pertemuan sudah habis'
        ], 422);
    }

    $exists = JadwalPertemuan::where('pendaftaran_id', $pendaftaran->id)
        ->where('pertemuan_ke', $request->pertemuan_ke)
        ->exists();

    if ($exists) {
        return response()->json([
            'message' => 'Pertemuan ini sudah diajukan'
        ], 409);
    }
    if ($pendaftaran->user_id !== auth()->id()) {
    return response()->json([
        'message' => 'Tidak berhak mengakses jadwal ini'
    ], 403);
}
$paidStatuses = ['paid', 'settlement', 'capture'];

if (
    !$pendaftaran->transaction ||
    !in_array($pendaftaran->transaction->transaction_status, $paidStatuses)
) {
    return response()->json([
        'message' => 'Pembayaran belum selesai'
    ], 403);
}
try {
    // kode store kamu
} catch (\Throwable $e) {
    \Log::error('ERROR SIMPAN JADWAL', [
        'message' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
        'trace' => $e->getTraceAsString()
    ]);

    return response()->json([
        'message' => 'Terjadi kesalahan server',
        'error' => $e->getMessage()
    ], 500);
}

$jamBentrok = JadwalPertemuan::where('tanggal', $request->tanggal)
    ->where('jam', $request->jam)
    ->whereIn('status', ['pending', 'approved'])
    ->exists();

if ($jamBentrok) {
    return response()->json([
        'message' => 'Jam ini sudah dipakai'
    ], 409);
}
$jadwal = null;

DB::transaction(function () use ($request, $pendaftaran, &$jadwal) {
    $jadwal = JadwalPertemuan::create([
        'pendaftaran_id' => $pendaftaran->id,
        'pertemuan_ke'   => $request->pertemuan_ke,
        'tanggal'        => $request->tanggal,
        'jam'            => $request->jam,
        'status'         => 'pending'
    ]);

});

    return response()->json([
        'message' => 'Jadwal berhasil diajukan',
        'data' => $jadwal
    ], 201);
}
public function index($pendaftaran_id)
{
    // Ambil pendaftaran
    $pendaftaran = Pendaftaran::where('id', $pendaftaran_id)
        ->where('user_id', auth()->id()) // 🔒 security
        ->first();

    if (!$pendaftaran) {
        return response()->json([
            'message' => 'Pendaftaran tidak ditemukan'
        ], 404);
    }

    // Ambil jadwal
    $jadwal = JadwalPertemuan::where('pendaftaran_id', $pendaftaran->id)
        ->orderBy('pertemuan_ke')
        ->get()
        ->map(function ($j) {
            return [
                'id' => $j->id,
                'pertemuan_ke' => $j->pertemuan_ke,
                'tanggal' => $j->tanggal,
                'jam' => $j->jam,
                'status' => $j->status,
            ];
        });

    return response()->json([
        'pendaftaran_id' => $pendaftaran->id,
        'paket' => $pendaftaran->paket,
        'total_pertemuan' => $pendaftaran->total_pertemuan,
        'sisa_pertemuan' => $pendaftaran->sisa_pertemuan,
        'jadwal' => $jadwal
    ]);
}
public function jamDipakai(Request $request)
{
    $tanggal = $request->tanggal;

    if (!$tanggal) {
        return response()->json(['jam_dipakai' => []], 422);
    }

    $jam = JadwalPertemuan::where('tanggal', $tanggal)
        ->whereIn('status', ['pending', 'approved'])
        ->pluck('jam');

    return response()->json([
        'jam_dipakai' => $jam
    ]);
}


    public function selesai($id)
{
    return DB::transaction(function () use ($id) {

        $jadwal = JadwalPertemuan::lockForUpdate()->find($id);

        if (!$jadwal) {
            return response()->json([
                'message' => 'Jadwal tidak ditemukan'
            ], 404);
        }

        // ❌ Cegah double selesai
        if ($jadwal->status === 'selesai') {
            return response()->json([
                'message' => 'Pertemuan sudah diselesaikan sebelumnya'
            ], 409);
        }

        $pendaftaran = Pendaftaran::lockForUpdate()
            ->find($jadwal->pendaftaran_id);

        if (!$pendaftaran) {
            return response()->json([
                'message' => 'Pendaftaran tidak ditemukan'
            ], 404);
        }

        // ❌ Cegah sisa minus
        if ($pendaftaran->sisa_pertemuan <= 0) {
            return response()->json([
                'message' => 'Sisa pertemuan sudah habis'
            ], 409);
        }

        // ✅ Update jadwal
        $jadwal->update([
            'status' => 'selesai'
        ]);

        // ✅ Kurangi sisa pertemuan
        $pendaftaran->decrement('sisa_pertemuan');

        return response()->json([
            'message' => 'Pertemuan berhasil diselesaikan',
            'total_pertemuan' => $pendaftaran->total_pertemuan, // 14
            'sisa_pertemuan' => $pendaftaran->sisa_pertemuan
        ]);
    });
}

}
