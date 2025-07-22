<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = 'admin@example.com';

        if (! User::where('email', $adminEmail)->exists()) {
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

        $testEmail = 'test@example.com';

        if (! User::where('email', $testEmail)->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => $testEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Test user created successfully.');
        } else {
            $this->command->info('Test user already exists.');
        }
    }
}
