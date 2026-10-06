<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('Login');});

Route::get('login', function () { return view('Login'); })->name('login');

Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('register', function () { return view('Register'); })->name('register');

Route::post('register', [LoginController::class, 'register'])->name('register.store');
