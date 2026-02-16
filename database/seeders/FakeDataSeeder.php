<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating 500 users with 300 todos each...');
        
        $password = Hash::make('11221122');
        $priorities = ['low', 'medium', 'high'];
        
        // Create 500 users
        for ($i = 1; $i <= 500; $i++) {
            $email = $i . '@gmail.com';
            
            // Check if user already exists
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => 'User ' . $i,
                    'email' => $email,
                    'password' => $password,
                    'email_verified_at' => now(),
                ]);
                
                $this->command->info('Created user: ' . $email);
            }
            
            // Check how many todos this user already has
            $existingTodos = Todo::where('user_id', $user->id)->count();
            
            // Create todos to reach 300
            $todosToCreate = 300 - $existingTodos;
            
            if ($todosToCreate > 0) {
                $todos = [];
                for ($j = 1; $j <= $todosToCreate; $j++) {
                    $todos[] = [
                        'user_id' => $user->id,
                        'title' => 'Todo ' . $j . ' for User ' . $i,
                        'description' => 'This is todo number ' . $j . ' for user ' . $i . '. ' . Str::random(50),
                        'priority' => $priorities[array_rand($priorities)],
                        'completed' => rand(0, 1) === 1,
                        'category' => ['Work', 'Personal', 'Shopping', 'Health', 'Education'][array_rand(['Work', 'Personal', 'Shopping', 'Health', 'Education'])],
                        'due_date' => now()->addDays(rand(-30, 30)),
                        'created_at' => now()->subDays(rand(0, 90)),
                        'updated_at' => now(),
                    ];
                }
                
                // Insert todos in chunks to avoid memory issues
                $chunks = array_chunk($todos, 50);
                foreach ($chunks as $chunk) {
                    Todo::insert($chunk);
                }
                
                $this->command->info('Created ' . $todosToCreate . ' todos for user: ' . $email);
            } else {
                $this->command->info('User ' . $email . ' already has ' . $existingTodos . ' todos, skipping...');
            }
        }
        
        $this->command->info('Fake data creation completed!');
        $this->command->info('Total users: ' . User::count());
        $this->command->info('Total todos: ' . Todo::count());
    }
}
