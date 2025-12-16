<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class PendaftaranForm extends Component
{
    public $nama_lengkap;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $alamat;
    public $jenis_kelamin;
    public $pekerjaan;
    public $mobil_dipilih;

    public $paket;
    public $harga = 0;
    public $metode_pembayaran = 'midtrans';

    protected $rules = [
        'nama_lengkap' => 'required|string',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required',
        'pekerjaan' => 'required|string',
        'mobil_dipilih' => 'required|string',
        'metode_pembayaran' => 'required',
    ];

   public function mount()
{
    $this->paket = request()->query('paket');
    $this->harga = (int) request()->query('harga', 0);
}


    public function submit()
{
    $this->validate();

    DB::beginTransaction();

    try {

        // 1️⃣ SIMPAN PENDAFTARAN
        $pendaftaran = Pendaftaran::create([
            'user_id'          => auth()->id(),
            'nama_lengkap'     => $this->nama_lengkap,
            'tempat_lahir'     => $this->tempat_lahir,
            'tanggal_lahir'    => $this->tanggal_lahir,
            'alamat'           => $this->alamat,
            'jenis_kelamin'    => $this->jenis_kelamin,
            'pekerjaan'        => $this->pekerjaan,
            'mobil_dipilih'    => $this->mobil_dipilih,
            'paket'            => $this->paket,
            'harga'            => $this->harga,
            'metode_pembayaran'=> $this->metode_pembayaran,
            'tanggal_daftar'   => now(),
        ]);

        // 2️⃣ JIKA BAYAR TUNAI → SELESAI
        if ($this->metode_pembayaran === 'tunai') {

            DB::commit();

            session()->flash('success_message', 'Pendaftaran berhasil. Silakan bayar di tempat.');
            return;
        }

        // ===================================================
        // 3️⃣ JIKA MIDTRANS → DI SINI KODE KAMU DILETAKKAN
        // ===================================================
        if ($this->metode_pembayaran === 'midtrans') {

            $midtrans = app(\App\Services\MidtransService::class);

            $result = $midtrans->createTransaction($pendaftaran);

            DB::commit();

            // 🔥 KIRIM EVENT KE JAVASCRIPT
            $this->dispatch('open-midtrans', [
                'token' => $result['snap_token']
            ]);
        }

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);
        session()->flash('error', 'Terjadi kesalahan, silakan coba lagi.');
    }
}

    public function render()
    {
        return view('livewire.pendaftaran-form');
    }
}
