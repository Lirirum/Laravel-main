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
Route::get('/character/{id}', [PageController::class, 'showCharacter']);
Route::get('/characters/create', [PageController::class, 'characterCreate']);
Route::get('/characters/edit/{id}', [PageController::class, 'characterEdit']);
Route::get('/characters/delete/{id}', [PageController::class, 'characterDelete']);
 

Route::post('/characters', [PageController::class, 'characterPost'])->name('characterPost');
Route::post('/characters/update/{id}', [PageController::class, 'characterUpdate'])->name('character.update');
Route::post('/characters/destroy/{id}', [PageController::class, 'characterDestroy'])->name('character.destroy');

Route::get('/ifno', function () {
    return view('info');
})->name('info');


Route::get('/redirect', RedirectController::class);