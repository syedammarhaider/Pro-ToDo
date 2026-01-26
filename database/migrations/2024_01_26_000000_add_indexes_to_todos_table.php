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
            // Add indexes for performance optimization
            $table->index(['completed'], 'idx_completed');
            $table->index(['category'], 'idx_category');
            $table->index(['priority'], 'idx_priority');
            $table->index(['created_at'], 'idx_created_at');
            $table->index(['due_date'], 'idx_due_date');
            $table->index(['completed', 'priority'], 'idx_completed_priority');
            $table->index(['completed', 'category'], 'idx_completed_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex('idx_completed');
            $table->dropIndex('idx_category');
            $table->dropIndex('idx_priority');
            $table->dropIndex('idx_created_at');
            $table->dropIndex('idx_due_date');
            $table->dropIndex('idx_completed_priority');
            $table->dropIndex('idx_completed_category');
        });
    }
};
