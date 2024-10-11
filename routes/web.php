<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RedirectController;

Route::get('/', function () {
    return view('welcome');
});


// Маршрут для головної сторінки
Route::get('/', [PageController::class, 'home'])->name('home');

// Маршрут для сторінки "Про нас"
Route::get('/about', [PageController::class, 'about'])->name('about');

// Маршрут для сторінки "Контакти"
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/services', [PageController::class, 'servicses'])->name('services');

// Маршрут з параметром
Route::get('/character/{name}', [PageController::class, 'showCharacter']);


Route::get('/ifno', function () {
    return view('info');
})->name('info');


Route::get('/redirect', RedirectController::class);