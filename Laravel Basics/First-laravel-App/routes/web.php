<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts.index');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
