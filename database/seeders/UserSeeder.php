<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 fake users
        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => "User {$i}",
                'email' => "user{$i}@example.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Same password for all users
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
