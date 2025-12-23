<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pendaftaran;
use App\Models\Transaction;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'paket'            => 'required|string',
            'harga'            => 'required|integer',
            'metode_pembayaran'=> 'required|in:midtrans,cash',

            'nama_lengkap'     => 'required|string',
            'tempat_lahir'     => 'required|string',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|string',
            'alamat'           => 'required|string',
            'pekerjaan'        => 'required|string',
            'mobil_dipilih'    => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Simpan Pendaftaran
            $pendaftaran = Pendaftaran::create([
                'user_id'          => auth()->id(),
                'paket'            => $request->paket,
                'harga'            => $request->harga,
                'metode_pembayaran'=> $request->metode_pembayaran,

                'nama_lengkap'     => $request->nama_lengkap,
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'    => $request->tanggal_lahir,
                'jenis_kelamin'    => $request->jenis_kelamin,
                'alamat'           => $request->alamat,
                'pekerjaan'        => $request->pekerjaan,
                'mobil_dipilih'    => $request->mobil_dipilih,

                'tanggal_daftar'   => now(),
            ]);

            // 2️⃣ Tentukan status transaksi
            $status = $request->metode_pembayaran === 'cash'
                ? 'waiting_cash'
                : 'pending';

            // 3️⃣ Buat transaksi dengan logging jika gagal
            try {
                $transaction = Transaction::create([
                    'pendaftaran_id'     => $pendaftaran->id,
                    'midtrans_order_id'  => 'ORDER-' . Str::uuid(),
                    'amount'             => $request->harga,
                    'transaction_status' => $status,
                ]);
            } catch (\Exception $e) {
                Log::error('Transaction gagal dibuat', [
                    'pendaftaran_id' => $pendaftaran->id,
                    'error'          => $e->getMessage()
                ]);

                // throw agar DB rollBack
                throw $e;
            }

            DB::commit();

            // 4️⃣ Redirect sesuai metode
            if ($request->metode_pembayaran === 'cash') {
                return redirect()
                    ->route('dashboard')
                    ->with('success', 'Pendaftaran berhasil. Silakan lakukan pembayaran cash.');
            }

            // MIDTRANS
            return redirect()
                ->route('payment.snap', $pendaftaran->id);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Pendaftaran gagal', [
                'user_id' => auth()->id(),
                'error'   => $e->getMessage()
            ]);

            return back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
