<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Recetas
    Route::get('/createRecipe',        [RecipeController::class, 'create'])->name('createRecipe');
    Route::post('/recipes',            [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{id}',        [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{id}/edit',   [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{id}',        [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{id}',     [RecipeController::class, 'destroy'])->name('recipes.destroy');
});

require __DIR__.'/settings.php';
