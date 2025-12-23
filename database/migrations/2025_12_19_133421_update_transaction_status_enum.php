<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan nilai baru ke enum transaction_status jika belum ada
        DB::statement("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'transaction_status_enum') THEN
                CREATE TYPE transaction_status_enum AS ENUM ('pending', 'waiting_cash', 'paid', 'failed');
            ELSE
                -- Tambahkan nilai baru jika belum ada
                BEGIN
                    ALTER TYPE transaction_status_enum ADD VALUE IF NOT EXISTS 'waiting_cash';
                EXCEPTION
                    WHEN duplicate_object THEN null;
                END;
                
                BEGIN
                    ALTER TYPE transaction_status_enum ADD VALUE IF NOT EXISTS 'failed';
                EXCEPTION
                    WHEN duplicate_object THEN null;
                END;
            END IF;
        END $$;");

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
