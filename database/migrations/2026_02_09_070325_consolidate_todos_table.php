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
        // Drop existing todos table if it exists
        Schema::dropIfExists('todos');

        // Create consolidated todos table
        Schema::create('todos', function (Blueprint $table) {
            $table->id(); // Primary key ID - Autoincrement
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title'); // Todo ka title - Todo title
            $table->text('description')->nullable(); // Tafseel - Description
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Awamiyat - Priority level
            $table->boolean('completed')->default(false); // Mukammal status - Completion status
            $table->date('due_date')->nullable(); // Akhri tareekh - Due date
            $table->string('category')->nullable(); // Category - Todo category
            $table->json('tags')->nullable(); // Tags - For multiple tags
            $table->integer('position')->default(0); // Tarteeb - Display order
            $table->softDeletes(); // Soft delete ke liye - For soft deletion
            $table->timestamps(); // Creation aur update timestamps

            // Add indexes for performance
            $table->index(['user_id', 'completed']);
            $table->index('priority');
            $table->index('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
