<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ApiAuthController;


// ==========================================
// ROUTE AUTHENTICATION API
// ==========================================

Route::post('/login', [ApiAuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('api.login');

Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout'])
    ->name('api.logout');


// ==========================================
// ROUTE BOOK
// ==========================================

Route::get('/books', [BookController::class, 'index'])
    ->name('books.api.index');

Route::get('/books/{id}', [BookController::class, 'show'])
    ->name('books.api.show');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/books', [BookController::class, 'store'])
        ->name('books.api.store');

    Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])
        ->name('books.api.update');

    Route::delete('/books/{id}', [BookController::class, 'destroy'])
        ->name('books.api.destroy');
});


// ==========================================
// ROUTE GENRE
// ==========================================

Route::apiResource('genres', GenreController::class)
    ->only(['index', 'show']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('genres', GenreController::class)
        ->only(['store', 'update', 'destroy']);
});


// ==========================================
// ROUTE AUTHOR
// ==========================================

Route::apiResource('authors', AuthorController::class)
    ->only(['index', 'show']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('authors', AuthorController::class)
        ->only(['store', 'update', 'destroy']);
});


// ==========================================
// ROUTE TRANSACTION
// ==========================================

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/{id}', [TransactionController::class, 'show'])
        ->name('transactions.show');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
});