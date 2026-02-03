<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/series', [SeriesController::class, 'index']);
Route::get('/genres', [GenreController::class, 'index']);


Route::get('/import/movie', [MovieController::class, 'import']);
Route::get('/import/series', action: [SeriesController::class, 'import']);
Route::get('/import/genres', action: [GenreController::class, 'import']);