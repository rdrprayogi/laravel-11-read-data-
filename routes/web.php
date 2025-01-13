<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/users', [UserController::class, 'index'])->name('users');


Route::resource('users', UserCrud::class);

