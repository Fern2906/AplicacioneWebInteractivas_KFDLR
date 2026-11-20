<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard')->name('home');

Route::view('dashboard', 'dashboard')->name('dashboard');
Route::get('weather/forecast', [WeatherController::class, 'forecast'])->name('weather.forecast');

require __DIR__.'/settings.php';
