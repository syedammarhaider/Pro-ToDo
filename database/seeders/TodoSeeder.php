<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
 
class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chunkSize = 10000;
        $totalRecords = 1000000;
        $chunks = $totalRecords / $chunkSize;
        
        $this->command->info("Creating {$totalRecords} todos in {$chunks} chunks of {$chunkSize}...");
        
        for ($i = 0; $i < $chunks; $i++) {
            Todo::factory($chunkSize)->create();
            $this->command->info("Created chunk " . ($i + 1) . " of {$chunks}");
        }
        
        $this->command->info("Successfully created {$totalRecords} todos!");
    }
}
