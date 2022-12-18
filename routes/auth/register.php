<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::controller(RegisterController::class)->prefix('register')->group(function () {
        Route::get('/{token}', 'create')->name('register.create');
        Route::post('/', 'store')->name('register.store');
    });
});
