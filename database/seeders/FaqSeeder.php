<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama agar id konsisten
        DB::table('faqs')->truncate();

        DB::table('faqs')->insert([
            [
                'keyword'   => 'cara daftar',
                'answer'    => 'Untuk mendaftar, silakan pilih paket kursus yang tersedia lalu lengkapi formulir pendaftaran.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword'   => 'metode pembayaran',
                'answer'    => 'Kami menyediakan metode pembayaran transfer bank, kredit, dan tunai.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword'   => 'jadwal kursus',
                'answer'    => 'Jadwal kursus dapat diajukan setelah pendaftaran berhasil melalui menu pengajuan jadwal.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword'   => 'lupa password',
                'answer'    => 'Jika lupa password, silakan gunakan fitur lupa password pada halaman login.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'keyword'   => 'hubungi admin',
                'answer'    => 'Silakan hubungi admin melalui menu chat atau kontak yang tersedia di aplikasi.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
