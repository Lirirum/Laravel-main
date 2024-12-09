<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PageController::class, 'home'])->name('home');



Route::get('/ifno', function () {
    return view('info');
})->name('info');




Route::get('/character/{id}', [PageController::class, 'showCharacter']);   
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/services', [PageController::class, 'servicses'])->name('services');


Route::prefix('api')->group(function () {
    Route::resource('characters', CharacterController::class);
    
});


Route::get('/posts', [BlogController::class, 'index'])->name('posts.index');

Route::middleware("auth")->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/secret', [PageController::class, 'secret'])->name('secret');
    Route::get('/characters/edit/{id}', [PageController::class, 'characterEdit']);
    Route::get('/characters/delete/{id}', [PageController::class, 'characterDelete']);
    Route::get('/characters/create', [PageController::class, 'characterCreate']);
    Route::post('/characters', [PageController::class, 'characterPost'])->name('characterPost');
    Route::post('/characters/update/{id}', [PageController::class, 'characterUpdate'])->name('character.update');
    Route::post('/characters/destroy/{id}', [PageController::class, 'characterDestroy'])->name('character.destroy');

    Route::get('/posts/create', [BlogController::class, 'create'])->name('posts.create');
    Route::post('/posts', [BlogController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [BlogController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [BlogController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [BlogController::class, 'destroy'])->name('posts.destroy');

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    

});

Route::middleware("guest")->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [AuthController::class, 'login'])->name('login_process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [AuthController::class, 'register'])->name('register_process');
   
    

  
});