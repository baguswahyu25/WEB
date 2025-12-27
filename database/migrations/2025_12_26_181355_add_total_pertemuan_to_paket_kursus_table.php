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
    Schema::table('paket_kursus', function (Blueprint $table) {
        $table->integer('total_pertemuan')->default(14)
              ->after('harga');
    });
}

public function down()
{
    Schema::table('paket_kursus', function (Blueprint $table) {
        $table->dropColumn('total_pertemuan');
    });
}

};
