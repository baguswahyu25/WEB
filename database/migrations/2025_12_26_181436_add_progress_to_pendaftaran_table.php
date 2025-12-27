<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pendaftaran', function (Blueprint $table) {
        $table->integer('total_pertemuan')->after('paket_kursus_id');
        $table->integer('sisa_pertemuan')->after('total_pertemuan');
        $table->enum('status_pendaftaran', ['aktif','selesai','dibatalkan'])
              ->default('aktif');
    });
}

public function down()
{
    Schema::table('pendaftaran', function (Blueprint $table) {
        $table->dropColumn([
            'total_pertemuan',
            'sisa_pertemuan',
            'status_pendaftaran'
        ]);
    });
}

};
