<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Yahan aap web routes register kar sakte hain.
|
*/

// Redirect root to todos index - Root se todos index par redirect karen
Route::redirect('/', '/todos');

// Todo resource routes with additional actions
// Todo resource routes aur additional actions
Route::prefix('todos')->name('todos.')->group(function () {
    // Main CRUD operations - Main CRUD operations
    Route::get('/', [TodoController::class, 'index'])->name('index'); // List all todos 
    Route::get('/create', [TodoController::class, 'create'])->name('create'); // Create form 
    Route::post('/', [TodoController::class, 'store'])->name('store'); // Store new todo 
    Route::get('/{todo}', [TodoController::class, 'show'])->name('show'); // Show single todo 
    Route::get('/{todo}/edit', [TodoController::class, 'edit'])->name('edit'); // Edit form 
    Route::put('/{todo}', [TodoController::class, 'update'])->name('update'); // Update todo 
   // Move the delete route before the show route
Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('destroy'); // Soft delete todo
Route::get('/{todo}', [TodoController::class, 'show'])->name('show'); // Show single todo



    // Additional actions - Additional actions
    Route::post('/{todo}/complete', [TodoController::class, 'complete'])->name('complete'); // Mark complete - Complete mark karen
    Route::post('/{todo}/incomplete', [TodoController::class, 'incomplete'])->name('incomplete'); // Mark incomplete - Incomplete mark karen
    
    // Bulk operations - Ek saath multiple operations
    Route::post('/bulk-delete', [TodoController::class, 'bulkDelete'])->name('bulk-delete'); // Bulk delete - Ek saath delete karen
    Route::post('/bulk-complete', [TodoController::class, 'bulkComplete'])->name('bulk-complete'); // Bulk complete - Ek saath complete karen
    
    // Drag & drop position update - Drag & drop se position update
    Route::post('/update-positions', [TodoController::class, 'updatePositions'])->name('update-positions'); // Update positions - Positions update karen
    
    // Trash management - Trash management
    Route::get('/trash', [TodoController::class, 'trash'])->name('trash'); // View trash - Trash dikhayen
    Route::post('/{id}/restore', [TodoController::class, 'restore'])->name('restore'); // Restore todo - Todo wapas laayen
    Route::delete('/{id}/force-delete', [TodoController::class, 'forceDelete'])->name('force-delete'); // Permanent delete - Permanent delete karen
    
    // Statistics - Statistics
    Route::get('/statistics', [TodoController::class, 'statistics'])->name('statistics'); // Get statistics - Statistics hasil karen
});

// Fallback route for 404 errors
// 404 errors ke liye fallback route
Route::fallback(function () {
    return redirect()->route('todos.index');
});