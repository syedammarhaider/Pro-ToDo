<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('todos.index') : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Todo routes
    Route::resource('todos', TodoController::class);
    Route::get('/todos/trash', [TodoController::class, 'trash'])->name('todos.trash');
    Route::post('/todos/{id}/restore', [TodoController::class, 'restore'])->name('todos.restore');
    Route::delete('/todos/{id}/force-delete', [TodoController::class, 'forceDelete'])->name('todos.force-delete');
    Route::post('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todos.complete');
    Route::post('/todos/{todo}/incomplete', [TodoController::class, 'incomplete'])->name('todos.incomplete');
    Route::post('/todos/update-positions', [TodoController::class, 'updatePositions'])->name('todos.update-positions');
    Route::delete('/todos/bulk-delete', [TodoController::class, 'bulkDelete'])->name('todos.bulk-delete');
    Route::post('/todos/bulk-complete', [TodoController::class, 'bulkComplete'])->name('todos.bulk-complete');
    Route::get('/todos/statistics', [TodoController::class, 'statistics'])->name('todos.statistics');
});

require __DIR__.'/auth.php';
