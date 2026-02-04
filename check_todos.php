<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== Todo Database Check ===\n";

try {
    // Check total todos
    $totalTodos = \App\Models\Todo::count();
    echo "Total todos in database: {$totalTodos}\n";
    
    // Check todos with user_id
    $todosWithUserId = \App\Models\Todo::whereNotNull('user_id')->count();
    echo "Todos with user_id: {$todosWithUserId}\n";
    
    // Check todos without user_id
    $todosWithoutUserId = \App\Models\Todo::whereNull('user_id')->count();
    echo "Todos without user_id: {$todosWithoutUserId}\n";
    
    // If there are todos without user_id, update them
    if ($todosWithoutUserId > 0) {
        echo "\n=== Updating todos without user_id ===\n";
        
        // Get the first user ID
        $firstUser = \App\Models\User::first();
        if ($firstUser) {
            $updated = \App\Models\Todo::whereNull('user_id')->update(['user_id' => $firstUser->id]);
            echo "Updated {$updated} todos to user_id: {$firstUser->id}\n";
        } else {
            echo "No users found in database!\n";
        }
    }
    
    // Show sample todos
    echo "\n=== Sample Todos ===\n";
    $sampleTodos = \App\Models\Todo::take(5)->get(['id', 'title', 'user_id']);
    foreach ($sampleTodos as $todo) {
        echo "ID: {$todo->id}, Title: {$todo->title}, User ID: " . ($todo->user_id ?? 'NULL') . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Check Complete ===\n";
