<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

Route::resource('posts', PostController::class);


Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Another way to implement middleware by group


// Route::middleware('guest')->group(function () {

//     Route::view('/', 'posts/index')->name('home');

//     Route::view('/register', 'auth.register')->name('register');
//     Route::post('/register', [AuthController::class, 'register']);

//     Route::view('/login', 'auth.login')->name('login');
//     Route::post('/login', [AuthController::class, 'login']);
// });



// Route::middleware('auth')->group(function () {

//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });
