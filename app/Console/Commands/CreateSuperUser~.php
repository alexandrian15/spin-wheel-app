<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperUser extends Command
{
    // Ini adalah perintah yang akan diketik di terminal nanti
    protected $signature = 'make:superuser'; 
    protected $description = 'Membuat akun super user / admin baru';

    public function handle()
    {
        $name = $this->ask('Masukkan Nama Admin');
        $email = $this->ask('Masukkan Email Admin');
        $password = $this->secret('Masukkan Password Admin');

        // Validasi sederhana, pastikan email belum terdaftar
        if (User::where('email', $email)->exists()) {
            $this->error('Email tersebut sudah terdaftar!');
            return;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin', // Sesuaikan kolom role di databasemu
        ]);

        $this->info("Akun Super User {$name} berhasil dibuat!");
    }
}