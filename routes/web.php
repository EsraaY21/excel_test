<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('todos')->group(function () {
    // Import Routes
    Route::get('importForm', [TodoController::class, 'importForm'])->name('todos.importForm');
    Route::post('importStore', [TodoController::class, 'importStore'])->name('todos.importStore');

    // CRUD Routes
    Route::get('/', [TodoController::class, 'index'])->name('todos.index');      // List all todos
    Route::get('create', [TodoController::class, 'create'])->name('todos.create'); // Show the create form
    Route::post('/', [TodoController::class, 'store'])->name('todos.store');       // Store a new todo

    // These need to be specific to avoid conflicts with the {todo} wildcard
    Route::get('{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit'); // Show the edit form
    Route::put('{todo}', [TodoController::class, 'update'])->name('todos.update');  // Update the todo
    Route::delete('{todo}', [TodoController::class, 'destroy'])->name('todos.destroy'); // Delete the todo
    
    // This wildcard route should come last to prevent conflicts
    Route::get('{todo}', [TodoController::class, 'show'])->name('todos.show');     // Show a specific todo
});


