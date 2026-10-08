<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\JugadorController;
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

Route::get('tournamentform', [AdminController::class, 'create'])->name('tournamentform')->middleware('auth');

Route::post('tournamentform', [AdminController::class, 'store'])->name('tournamentform.store')->middleware('auth');

Route::get('tournamentform/{torneo}/edit', [AdminController::class, 'edit'])->name('tournamentform.edit')->middleware('auth');

Route::put('tournamentform/{torneo}', [AdminController::class, 'update'])->name('tournamentform.update')->middleware('auth');

Route::delete('tournamentform/{torneo}', [AdminController::class, 'destroy'])->name('tournamentform.destroy')->middleware('auth');

// Torneo detail (public)
Route::get('torneos/{torneo}', [AdminController::class, 'show'])->name('torneo.show');

// Inscripciones
Route::post('torneos/{torneo}/inscribirse', [InscripcionController::class, 'store'])->name('inscripcion.store')->middleware('auth');
Route::delete('inscripciones/{inscripciones}', [InscripcionController::class, 'destroy'])->name('inscripcion.destroy')->middleware('auth');

// Jugador: mis torneos
Route::get('mis-torneos', [JugadorController::class, 'index'])->name('mis-torneos')->middleware('auth');
