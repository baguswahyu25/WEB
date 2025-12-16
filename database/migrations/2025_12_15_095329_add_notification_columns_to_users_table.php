<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notif_cs')->default(true)->after('profile_photo_path');
            $table->boolean('notif_promo')->default(true)->after('notif_cs');
            $table->boolean('notif_update')->default(true)->after('notif_promo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['notif_cs', 'notif_promo', 'notif_update']);
        });
    }
};

