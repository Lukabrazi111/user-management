<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->prefix('login')->group(function () {
        Route::get('/', 'index')->name('login.index');
        Route::post('/', 'login')->name('login');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
