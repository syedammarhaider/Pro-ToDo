<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== Assigning Todos to User Ali ===\n";

try {
    // Get user ali (ID: 51)
    $user = \App\Models\User::find(51);
    
    if ($user) {
        echo "Found user: {$user->name} (ID: {$user->id})\n";
        
        // Get some todos from other users to assign to ali
        $todosToReassign = \App\Models\Todo::where('user_id', '!=', 51)
            ->whereNotNull('user_id')
            ->take(10)
            ->get(['id', 'title', 'user_id']);
            
        echo "Found {$todosToReassign->count()} todos to reassign\n";
        
        foreach ($todosToReassign as $todo) {
            $oldUserId = $todo->user_id;
            $todo->user_id = 51;
            $todo->save();
            echo "- Reassigned todo ID {$todo->id} '{$todo->title}' from user {$oldUserId} to user 51\n";
        }
        
        // Also assign the NULL user_id todos
        $nullTodos = \App\Models\Todo::whereNull('user_id')->get(['id', 'title']);
        foreach ($nullTodos as $todo) {
            $todo->user_id = 51;
            $todo->save();
            echo "- Assigned orphan todo ID {$todo->id} '{$todo->title}' to user 51\n";
        }
        
        // Check final count
        $finalCount = \App\Models\Todo::where('user_id', 51)->count();
        echo "\nFinal todo count for user 51: {$finalCount}\n";
        
    } else {
        echo "User 51 not found!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Assignment Complete ===\n";
