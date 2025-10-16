<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk menampilkan daftar genre
Route::get('/genres', [GenreController::class, 'index']);

// Route untuk menampilkan daftar penulis
Route::get('/authors', [AuthorController::class, 'index']);