<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_sim', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id')->nullable(); 
    $table->string('paket');

    $table->string('nama_lengkap');
    $table->string('ttl');
    $table->text('alamat');
    $table->string('jenis_kelamin');
    $table->string('pekerjaan');

    $table->string('mobil_dipilih');
    $table->string('metode_pembayaran');
    $table->string('opsi_kredit')->nullable();

    $table->text('pas_foto_url')->nullable();
    $table->text('ktp_url')->nullable();

    $table->integer('harga')->default(0);
    $table->timestamp('tanggal_daftar')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_sim');
    }
};
