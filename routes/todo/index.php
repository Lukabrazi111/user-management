<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('/', 'create')->name('todo.create');
        Route::post('/', 'store')->name('todo.store');
    });
});

