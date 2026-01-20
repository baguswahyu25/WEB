<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->index(
                ['pendaftaran_id', 'type', 'transaction_status'],
                'transactions_pendaftaran_type_status_idx'
            );
            $table->index('midtrans_order_id');
            $table->index(['transaction_status', 'type']);

        });
    }

   public function down(): void
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropIndex('transactions_pendaftaran_type_status_idx');
        $table->dropIndex(['midtrans_order_id']);
        $table->dropIndex(['transaction_status', 'type']);
    });
}
};

