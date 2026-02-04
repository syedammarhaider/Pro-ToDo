<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

class UserTodoSeeder extends Seeder
{
    public function run(): void
    {
        $priorities = ['low', 'medium', 'high'];
        $categories = ['Work', 'Personal', 'Shopping', 'Health', 'Education', 'Finance', 'Travel', 'Home'];
        
        // Get all users
        $users = User::all();
        
        foreach ($users as $user) {
            // Create 20 todos for each user
            for ($i = 1; $i <= 20; $i++) {
                $dueDate = now()->addDays(rand(1, 30));
                $completed = rand(0, 1) === 1;
                
                Todo::create([
                    'user_id' => $user->id,
                    'title' => "Todo {$i} for {$user->name}",
                    'description' => "This is todo number {$i} for user {$user->name}. It has a detailed description about what needs to be done.",
                    'priority' => $priorities[array_rand($priorities)],
                    'completed' => $completed,
                    'due_date' => $completed ? null : $dueDate,
                    'category' => $categories[array_rand($categories)],
                    'position' => $i,
                    'created_at' => now()->subDays(rand(0, 30)),
                    'updated_at' => now()->subDays(rand(0, 10)),
                ]);
            }
        }
    }
}
