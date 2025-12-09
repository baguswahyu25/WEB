<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            // Data diri
            $table->string('nama_lengkap');
            $table->string('ttl'); // contoh: Jakarta, 01/01/2000
            $table->text('alamat_lengkap');
            $table->string('jenis_kelamin');
            $table->string('pekerjaan');

            // Pilih mobil
            $table->string('nama_mobil'); // avanza / ayla / calya / brio / mobilio

            // Metode pembayaran
            $table->string('metode_pembayaran'); // transfer / kredit / tunai

            // Jika kredit, pilihannya: minggu / bulan / tahun
            $table->string('opsi_kredit')->nullable();

            // Untuk info paket yang dipilih
            $table->string('paket')->nullable();

            // Konfirmasi checklist
            $table->boolean('konfirmasi')->default(false);

            // Relasi user (opsional)
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
