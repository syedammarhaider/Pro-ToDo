<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== User Todo Check ===\n";

try {
    // Check if user "ali" exists
    $user = \App\Models\User::where('name', 'like', '%ali%')->orWhere('email', 'like', '%ali%')->first();
    
    if ($user) {
        echo "Found user: {$user->name} (ID: {$user->id}, Email: {$user->email})\n";
        
        // Check todos for this user
        $userTodos = \App\Models\Todo::where('user_id', $user->id)->get();
        echo "Todos for user {$user->id}: {$userTodos->count()}\n";
        
        if ($userTodos->count() > 0) {
            echo "\nUser's todos:\n";
            foreach ($userTodos as $todo) {
                echo "- ID: {$todo->id}, Title: {$todo->title}, Priority: {$todo->priority}\n";
            }
        } else {
            echo "No todos found for this user.\n";
        }
        
        // Check all todos and their user_id distribution
        echo "\n=== All todos by user_id ===\n";
        $todosByUser = \App\Models\Todo::select('user_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('user_id')
            ->get();
            
        foreach ($todosByUser as $group) {
            $userId = $group->user_id ?? 'NULL';
            $count = $group->count;
            echo "User ID {$userId}: {$count} todos\n";
        }
        
    } else {
        echo "User 'ali' not found. Checking all users...\n";
        
        $allUsers = \App\Models\User::take(5)->get(['id', 'name', 'email']);
        echo "Available users:\n";
        foreach ($allUsers as $u) {
            $todoCount = \App\Models\Todo::where('user_id', $u->id)->count();
            echo "- ID: {$u->id}, Name: {$u->name}, Email: {$u->email}, Todos: {$todoCount}\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Check Complete ===\n";
