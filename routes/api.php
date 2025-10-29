<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route untuk daftar genre
Route::apiResource('/genres', GenreController::class);

// Route untuk daftar penulis
Route::apiResource('/authors', AuthorController::class);

// Route untuk daftar buku
Route::apiResource('/books', BookController::class);