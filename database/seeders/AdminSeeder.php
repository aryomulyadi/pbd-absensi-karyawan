<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cegah duplicate untuk Super Admin
        if (!User::where('email', 'superadmin@example.com')->exists()) {
            User::factory()->admin(superadmin: true)->create([
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('superadmin'),
                'raw_password' => 'superadmin',
            ]);
        }

        // Cegah duplicate untuk Admin biasa
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->admin()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'raw_password' => 'admin',
            ]);
        }
    }
}
