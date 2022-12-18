<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('todo.index');
    })->name('todo.index');
});
