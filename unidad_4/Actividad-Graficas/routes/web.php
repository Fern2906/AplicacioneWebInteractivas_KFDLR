<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('weather/forecast', [WeatherController::class, 'forecast'])->name('weather.forecast');
});

require __DIR__.'/settings.php';
