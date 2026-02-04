<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== Deleting All Existing Data ===\n";

try {
    // Reset auto-increment and truncate tables
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    \Illuminate\Support\Facades\DB::statement('TRUNCATE TABLE users');
    \Illuminate\Support\Facades\DB::statement('TRUNCATE TABLE todos');
    \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    echo "Truncated users and todos tables\n";
    echo "Reset auto-increment counters\n";
    
    echo "\n=== Data Deletion Complete ===\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Ready to Create New Data ===\n";
