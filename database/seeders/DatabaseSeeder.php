<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding Admin
        User::factory()->create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Seeding Regular User
        User::factory()->create([
            'name' => 'Kasir Bengkel',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => bcrypt('user123'),
        ]);
    }
}
