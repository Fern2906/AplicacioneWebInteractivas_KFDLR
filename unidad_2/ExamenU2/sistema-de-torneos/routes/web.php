<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login');
});

Route::get('login', function () {
    return view('Login');
})->name('login');

Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('register', function () {
    return view('Register');
})->name('register');

Route::post('register', [LoginController::class, 'register'])->name('register.store');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('createtournament', [AdminController::class, 'create'])->name('createtournament')->middleware('auth');

Route::post('createtournament', [AdminController::class, 'store'])->name('createtournament.store')->middleware('auth');
