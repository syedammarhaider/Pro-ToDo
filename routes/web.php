<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('todos.index') : redirect()->route('login');
});

Route::get('/hr', function () {
    return 'Human Resources section - Coming Soon!';
})->name('hr.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Todo routes
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show');
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

    // Todo status routes
    Route::post('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todos.complete');
    Route::post('/todos/{todo}/incomplete', [TodoController::class, 'incomplete'])->name('todos.incomplete');

    // Bulk operations
    Route::post('/todos/bulk-complete', [TodoController::class, 'bulkComplete'])->name('todos.bulk-complete');
    Route::post('/todos/bulk-delete', [TodoController::class, 'bulkDelete'])->name('todos.bulk-delete');

    // User Management (Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});

require __DIR__.'/auth.php';
