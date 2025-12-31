<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketKursusSeeder extends Seeder
{
    public function run()
    {
        DB::table('paket_kursus')->truncate();

        DB::table('paket_kursus')->insert([
            [
                'nama' => 'Paket Manual',
                'harga' => 1500000,
                'tipe' => 'manual',
                'image' => 'paket_kursus/manual/paket_manual.jpeg', // folder + ekstensi sesuai storage
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Paket Automatic',
                'harga' => 1800000,
                'tipe' => 'automatic',
                'image' => 'paket_kursus/automatic/paket_automatic.jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Paket Manual + SIM',
                'harga' => 2150000,
                'tipe' => 'manual_sim',
                'image' => 'paket_kursus/manual/paket_manual.jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Paket Automatic + SIM',
                'harga' => 2450000,
                'tipe' => 'automatic_sim',
                'image' => 'paket_kursus/automatic/paket_automatic.jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
