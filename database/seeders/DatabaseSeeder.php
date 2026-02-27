<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * This seeder is idempotent - safe to run multiple times
     */
    public function run(): void
    {
        // Admin password
        $adminPassword = Hash::make('Fr4nzJermido');

        // Create or update Admin User (idempotent)
        User::updateOrCreate(
            ['email' => 'admin@gad.gov.ph'],
            [
                'name' => 'Admin User',
                'password' => $adminPassword,
                'role' => 'administrator',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Create or get Test User (idempotent)
        if (env('APP_ENV') !== 'production') {
            User::firstOrCreate(
                ['email' => 'test@example.com'],
                [
                    'name' => 'Test User',
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
        }

        // Call the comprehensive data seeder
        $this->call(ComprehensiveDataSeeder::class);
    }
}

