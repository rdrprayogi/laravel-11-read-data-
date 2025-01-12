<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', function () {
    return view('users', [UserController::class, 'index']);
})->name('users');

