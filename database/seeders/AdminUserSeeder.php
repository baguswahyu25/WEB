<?php

// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User diimpor

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // Pastikan Anda tidak membuat admin duplikat
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'Adminkeren',
                'email' => 'samsgtaja05@gmail.com',
                // PENTING: Hash kata sandi! Gunakan kata sandi yang kuat
                'password' => Hash::make('1234512345'), 
                'role' => 'admin', // Ini yang membedakan
            ]);
        }
    }
}