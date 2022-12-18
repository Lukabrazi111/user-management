<?php

use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::controller(InvitationController::class)->prefix('invitation')->group(function () {
    Route::get('/', 'create')->name('invitation.create');
    Route::post('/', 'store')->name('invitation.store');
});
