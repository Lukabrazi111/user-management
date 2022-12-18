<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'index')->name('login.index');
    Route::post('/', 'login')->name('login');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
