<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('/', 'create')->name('todo.create');
        Route::post('/', 'store')->name('todo.store');
        Route::put('/{todo}', 'update')->name('todo.update');
        Route::put('/status/{todo}', 'updateStatus')->name('todo.update.status');
        Route::delete('/{todo}', 'destroy')->name('todo.destroy');
    });
});

