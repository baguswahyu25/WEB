<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('promos')->insert([
            [
                'title' => 'Promo Pengguna Baru',
                'subtitle' => 'Khusus Member Baru',
                'description' => 'Diskon spesial untuk pengguna baru yang mendaftar kursus mengemudi.',
                'image_url' => 'promo/pengguna_baru.jpg',
                'expired_at' => Carbon::now()->addDays(30),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Promo Pengguna Lama',
                'subtitle' => 'Terima Kasih Telah Setia',
                'description' => 'Diskon spesial untuk pengguna lama yang mendaftar kursus mengemudi automatic.',
                'image_url' => 'promo/pengguna_lama.jpg',
                'expired_at' => Carbon::now()->addDays(20),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Promo Akhir Tahun',
                'subtitle' => 'Diskon Besar-besaran',
                'description' => 'Rayakan akhir tahun dengan promo spesial untuk semua paket kursus.',
                'image_url' => 'promo/akhir_tahun.jpg',
                'expired_at' => Carbon::create(date('Y'), 12, 31, 23, 59, 59),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
