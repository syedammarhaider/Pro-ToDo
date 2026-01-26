<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessTodoIncompletion implements ShouldQueue
{
    use Queueable;

    public function __construct(private Todo $todo) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mark todo as incomplete in database
        $this->todo->update(['completed' => false]);
        
        // Clear cache after incompletion
        \Illuminate\Support\Facades\Cache::forget('todo_stats');
        
        // Log the incompletion
        Log::info("Todo '{$this->todo->title}' (ID: {$this->todo->id}) has been marked as incomplete asynchronously.");
        
        // Additional heavy operations can go here:
        // - Send email notifications
        // - Update analytics
        // - Trigger webhooks
        // - Process related tasks
    }
}
