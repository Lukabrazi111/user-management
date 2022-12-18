<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::controller(InvitationController::class)->group(function () {
    Route::get('/register', 'create')->name('invitation.create');
    Route::post('/invitation', 'store')->name('invitation.store');
});
