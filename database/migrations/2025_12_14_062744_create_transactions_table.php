<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Pendaftaran
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            
            // Detail Midtrans
            $table->string('midtrans_order_id')->unique(); // Order ID unik Midtrans
            $table->decimal('amount', 10, 2); // Jumlah pembayaran
            $table->string('payment_method')->nullable(); // Metode yang digunakan (e.g., bank transfer, gopay)
            $table->string('transaction_token')->nullable(); // Token dari Midtrans (jika perlu)

            // Status
            $table->enum('transaction_status', ['pending', 'paid', 'failed', 'expire', 'settlement', 'cancel'])->default('pending');
            $table->timestamp('paid_at')->nullable(); // Waktu pembayaran sukses
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};