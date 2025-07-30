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
        // Hapus data lama agar tidak duplikat
        User::truncate();

        // Buat user contoh
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('donojaya'), // Ganti dengan password yang sesuai
        ]);

         User::factory()->create([
            'name' => 'AdminDono',
            'email' => 'donoadmin@gmail.com',
            'password' => bcrypt('donojaya'), // Ganti dengan password yang sesuai
        ]);
    }
}
