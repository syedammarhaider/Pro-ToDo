<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== Creating 300 Users with 300 Todos Each ===\n";

try {
    $totalUsers = 300;
    $todosPerUser = 300;
    $password = '11221122';
    
    echo "Creating {$totalUsers} users...\n";
    
    for ($i = 1; $i <= $totalUsers; $i++) {
        $email = $i . '@gmail.com';
        $name = 'User ' . $i;
        
        // Create user
        $user = \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'email_verified_at' => now(),
        ]);
        
        echo "Created user {$i}: {$email}\n";
        
        // Create 300 todos for this user
        for ($j = 1; $j <= $todosPerUser; $j++) {
            $priorities = ['low', 'medium', 'high'];
            $categories = ['Work', 'Personal', 'Shopping', 'Health', 'Study', 'Home'];
            
            \App\Models\Todo::create([
                'title' => "Todo {$j} for {$name}",
                'description' => "This is todo number {$j} for user {$name}",
                'priority' => $priorities[array_rand($priorities)],
                'category' => $categories[array_rand($categories)],
                'due_date' => now()->addDays(rand(1, 30)),
                'user_id' => $user->id,
                'completed' => rand(0, 10) > 8, // 20% chance of being completed
                'position' => $j,
            ]);
        }
        
        if ($i % 10 == 0) {
            echo "Completed {$i} users with " . ($i * $todosPerUser) . " todos\n";
        }
    }
    
    $totalTodos = $totalUsers * $todosPerUser;
    echo "\n=== Factory Creation Complete ===\n";
    echo "Total users created: {$totalUsers}\n";
    echo "Total todos created: {$totalTodos}\n";
    echo "Each user has {$todosPerUser} todos\n";
    echo "Password for all users: {$password}\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Factory Setup Complete ===\n";
