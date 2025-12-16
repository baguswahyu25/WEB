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

    $table->unsignedBigInteger('user_id')->nullable(); 
    $table->string('paket');

    // Data diri
    $table->string('nama_lengkap');
    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->text('alamat');
    $table->string('jenis_kelamin');
    $table->string('pekerjaan');

    // Mobil & pembayaran
    $table->string('mobil_dipilih');
    $table->string('metode_pembayaran');
    $table->string('opsi_kredit')->nullable();

    // Upload file (khusus SIM)
    $table->text('pas_foto_url')->nullable();
    $table->text('ktp_url')->nullable();

    // ✔ Harga
    $table->integer('harga')->default(0);

    // Tanggal daftar
    $table->timestamp('tanggal_daftar')->nullable();

    // ✔ Tipe pendaftaran
    $table->enum('tipe_pendaftaran', ['sim', 'non_sim'])->default('non_sim');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
