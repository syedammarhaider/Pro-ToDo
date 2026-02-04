<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions first
        $this->call([
            RoleAndPermissionSeeder::class,
        ]);

        // Create 50 fake users with 20 todos each
        $this->call([
            UserSeeder::class,
            UserTodoSeeder::class,
        ]);
    }
}
