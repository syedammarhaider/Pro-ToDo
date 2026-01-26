<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // Add indexes for ultra-fast queries
            $table->index(['completed', 'deleted_at'], 'todos_completed_deleted_at_index');
            $table->index(['priority', 'deleted_at'], 'todos_priority_deleted_at_index');
            $table->index(['due_date', 'deleted_at'], 'todos_due_date_deleted_at_index');
            $table->index(['category', 'deleted_at'], 'todos_category_deleted_at_index');
            $table->index(['position', 'deleted_at'], 'todos_position_deleted_at_index');
            $table->index(['created_at', 'deleted_at'], 'todos_created_at_deleted_at_index');

            // Composite indexes for common query patterns
            $table->index(['completed', 'priority', 'deleted_at'], 'todos_status_priority_deleted_at_index');
            $table->index(['completed', 'due_date', 'deleted_at'], 'todos_status_due_date_deleted_at_index');
            $table->index(['priority', 'due_date', 'deleted_at'], 'todos_priority_due_date_deleted_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            //
        });
    }
};
