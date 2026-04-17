<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (User::where('email', 'samsgtaja05@gmail.com')->doesntExist()) {

            User::create([
                'name' => 'Adminkeren',
                'email' => 'samsgtaja05@gmail.com',
                 'email_verified_at' => now(), // langsung dianggap verified
                'password' => Hash::make('1234512345'), // password akan di-hash
                'role' => 'admin',
            ]);

        }
    }
}