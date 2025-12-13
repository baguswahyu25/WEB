<?php
// File: database/migrations/YYYY_MM_DD_HHMMSS_create_pengajuan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_jadwal', function (Blueprint $table) {
            
            // 1. Kolom ID Utama
            $table->id(); 

            // 2. Relasi ke User (Foreign Key)
            // Ini akan membuat kolom unsignedBigInteger 'user_id' dan constraint foreign key ke tabel 'users'
            $table->foreignId('user_id')
                  ->constrained() // Secara default merujuk ke tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, pengajuan juga ikut terhapus

            // 3. Relasi ke Pendaftaran (untuk data mobil)
            // Merujuk ke tabel 'pendaftaran'
            $table->foreignId('pendaftaran_id')
                  ->constrained('pendaftaran') // Merujuk secara spesifik ke tabel 'pendaftaran'
                  ->onDelete('restrict'); // Mencegah pendaftaran dihapus jika masih ada pengajuan

           
            // 5. Kolom Pertemuan
            $table->date('tanggal'); // Kolom tanggal (Hanya tanggal, tanpa jam)
            $table->time('jam');    // Kolom jam (Hanya jam)
            $table->unsignedTinyInteger('pertemuan_ke'); // Kolom untuk menyimpan pertemuan ke berapa (Angka kecil, selalu positif)

            // 6. Kolom Timestamp
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

public function down(): void
    {
        // GANTI 'pengajuan' menjadi 'pengajuan_jadwal'
        Schema::dropIfExists('pengajuan_jadwal'); 
    }
};