<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookTrackerController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UsersController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth');
});

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/pass-update', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/library', [LibraryController::class, 'index'])->name('library');
    Route::post('/library/request/{bookID}', [LibraryController::class, 'makeRequest'])->name('library.request');

    Route::get('/book-tracker', [BookTrackerController::class, 'index'])->name('tracker');
});


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/issuances', [IssuanceController::class, 'index'])->name('issuances');

    Route::post('/get-book', [CatalogController::class, 'getBook']);
});

Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/auth', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


