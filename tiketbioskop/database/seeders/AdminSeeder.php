<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminEmail = 'admin@cinetix.com';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin Cinetix',
                'email' => $adminEmail,
                'password' => Hash::make('password'), // kamu bisa ganti dengan password lain
                'role' => 'admin',
            ]);
        }
    }
}
