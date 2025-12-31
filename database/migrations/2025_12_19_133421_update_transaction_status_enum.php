<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {

        // Tambahkan kolom baru midtrans_status jika belum ada
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'midtrans_status')) {
                $table->string('midtrans_status')->nullable()->after('transaction_status');
            }
        });
    }

    public function down(): void
    {
        // Drop kolom midtrans_status
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'midtrans_status')) {
                $table->dropColumn('midtrans_status');
            }
        });

        // NOTE: PostgreSQL tidak bisa menghapus value ENUM, jadi rollback tipe enum biasanya dilewati
    }
};
