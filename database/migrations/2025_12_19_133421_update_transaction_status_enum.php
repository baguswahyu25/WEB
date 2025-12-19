<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ubah enum transaction_status jadi status INTERNAL
        DB::statement("
            ALTER TABLE transactions 
            MODIFY transaction_status 
            ENUM('pending', 'waiting_cash', 'paid', 'failed') 
            NOT NULL DEFAULT 'pending'
        ");

        // 2. Tambah kolom untuk simpan status Midtrans (opsional tapi rapi)
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'midtrans_status')) {
                $table->string('midtrans_status')->nullable()->after('transaction_status');
            }
        });
    }

    public function down(): void
    {
        // rollback ke kondisi lama (kalau perlu)
        DB::statement("
            ALTER TABLE transactions 
            MODIFY transaction_status 
            ENUM('pending', 'paid', 'failed', 'expire', 'settlement', 'cancel') 
            NOT NULL DEFAULT 'pending'
        ");

        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'midtrans_status')) {
                $table->dropColumn('midtrans_status');
            }
        });
    }
};
