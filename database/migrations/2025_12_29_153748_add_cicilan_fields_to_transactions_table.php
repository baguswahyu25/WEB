<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            // Jenis transaksi: lunas / dp / cicilan
            $table->enum('type', ['lunas', 'dp', 'cicilan'])
                  ->default('lunas')
                  ->after('payment_method');

            // Khusus cicilan
            $table->unsignedInteger('cicilan_ke')->nullable()->after('type');
            $table->unsignedInteger('total_cicilan')->nullable()->after('cicilan_ke');

            // Kontrol jatuh tempo
            $table->date('jatuh_tempo')->nullable()->after('total_cicilan');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'cicilan_ke',
                'total_cicilan',
                'jatuh_tempo',
            ]);
        });
    }
};
