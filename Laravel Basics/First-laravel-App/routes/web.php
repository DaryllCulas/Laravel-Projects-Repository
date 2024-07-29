<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

Route::resource('posts', PostController::class);

// Route for register and register
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route for login and login
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route for logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route for dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

// Route for user posts
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');


// Route for Email Verification Notice
Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->middleware('auth')->name('verification.notice');


// Route for Email Verfication Handler
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

// Route for Resending Verification Email
Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::view('/forgot-password', 'auth.forgot-password')->middleware('guest')->name('password.request');


Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->middleware('guest');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->middleware('guest')->name('password.reset');


Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->middleware('guest')->name('password.update');










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
