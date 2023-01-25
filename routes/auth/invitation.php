<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(InvitationController::class)->group(function () {
        Route::get('/register', 'create')->name('invitation.create');
        Route::post('/invitation', 'store')->name('invitation.store');
    });
});
