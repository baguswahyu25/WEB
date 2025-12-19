<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('users', function (Blueprint $table) {
            // Kita akan menggunakan string dengan default 'user'
            $table->string('role')->default('user')->after('email');
            
            // Atau jika Anda suka enum:
            // $table->enum('role', ['user', 'admin', 'super_admin'])->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
