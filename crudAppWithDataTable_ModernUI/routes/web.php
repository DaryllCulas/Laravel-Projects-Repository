<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/payments', [PaymentController::class, 'index']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
