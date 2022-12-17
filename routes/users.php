<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', function () {
        return view('users.index');
    })->name('users.index');
});
