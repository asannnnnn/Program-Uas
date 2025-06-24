<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder lain
        $this->call([
            FilmSeeder::class,
            AdminSeeder::class,
        ]);

        // Buat 1 user contoh
       if (!User::where('email', 'test@example.com')->exists()) {
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
}
    }
}
