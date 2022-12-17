<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::controller(RegisterController::class)->prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/', [RegisterController::class, 'store'])->name('register.store');
});


