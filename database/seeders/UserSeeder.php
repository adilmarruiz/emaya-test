<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'admin123', // será encriptado por el mutator
            'phone_number' => '70112233',
        ]);

        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'phone_number' => '77445566',
        ]);

        User::factory()
            ->count(8)
            ->create(); // usuarios aleatorios
    }
}
