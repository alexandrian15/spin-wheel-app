<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Amankan akun superadmin agar tidak duplikat
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Cari berdasarkan email ini
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
            ]
        );

        // 2. Jika kode bawaan 'test@example.com' masih ada dan bikin error, 
        // kamu bisa ubah menjadi updateOrCreate juga seperti ini:
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}