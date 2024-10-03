<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\UsersController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('profile');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/library', function () {
    return view('library');
})->name('library');

Route::get('/checkout-form', function () {
    return view('checkout-form');
})->name('checkout');

Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/issuances', [IssuanceController::class, 'index'])->name('issuances');

Route::get('/auth', [AuthController::class, 'index']);

