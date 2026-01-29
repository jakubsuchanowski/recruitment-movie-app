<?php

use App\Http\Controllers\DataImportController;
use Illuminate\Support\Facades\Route;

Route::get('/import/movie', [DataImportController::class, 'import']);