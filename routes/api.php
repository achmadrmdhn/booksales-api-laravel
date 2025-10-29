<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TransactionController;

// AUTH (JWT)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/logout',   [AuthController::class, 'logout'])->middleware('auth:api');

// PUBLIC READ
Route::apiResource('/genres',  GenreController::class)->only(['index','show']);
Route::apiResource('/authors', AuthorController::class)->only(['index','show']);
Route::apiResource('/books',   BookController::class)->only(['index','show']);

// ADMIN (WRITE GENRE & AUTHOR & BOOKS)
Route::middleware(['auth:api','role:admin'])->group(function () {
    Route::apiResource('/genres',  GenreController::class)->only(['store','update','destroy']);
    Route::apiResource('/authors', AuthorController::class)->only(['store','update','destroy']);
    Route::apiResource('/books',   BookController::class)->only(['store','update','destroy']);
});

// TRANSACTIONS (ROLE-BASED)
// Customer — create, update, show (hanya transaksi miliknya)
Route::middleware(['auth:api','role:customer'])->group(function () {
    Route::post('/transactions',       [TransactionController::class, 'store']);
    Route::get('/transactions/{id}',   [TransactionController::class, 'show']);
    Route::match(['put','patch'], '/transactions/{id}', [TransactionController::class, 'update']);
});

// Admin — read all & destroy
Route::middleware(['auth:api','role:admin'])->group(function () {
    Route::get('/transactions',        [TransactionController::class, 'index']);
    Route::delete('/transactions/{id}',[TransactionController::class, 'destroy']);
});
