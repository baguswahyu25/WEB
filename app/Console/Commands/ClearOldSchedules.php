<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClearOldSchedules extends Command
{
    /**
     * Nama dan signature dari perintah console.
     * @var string
     */
    protected $signature = 'schedules:clear-old'; // Nama perintah yang akan dipanggil

    /**
     * Deskripsi perintah console.
     * @var string
     */
    protected $description = 'Menghapus data pengajuan jadwal yang sudah lewat tanggalnya.';

    /**
     * Jalankan perintah console.
     */
    public function handle()
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::today();

        // 1. Logika Penghapusan
        // Kita mencari data di tabel 'pengajuan_jadwal' di mana kolom 'tanggal'
        // lebih kecil dari tanggal hari ini.
        $deleted = DB::table('pengajuan_jadwal')
                     ->where('tanggal', '<', $today)
                     ->delete();

        // 2. Memberikan Notifikasi di Console
        $this->info("Berhasil membersihkan $deleted data jadwal lama dari database.");

        return 0;
    }
}