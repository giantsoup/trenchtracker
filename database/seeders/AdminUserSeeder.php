<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists to prevent duplicates
        $adminEmail = 'admin@example.com';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => $adminEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
