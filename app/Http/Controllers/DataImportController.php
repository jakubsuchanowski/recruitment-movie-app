<?php

namespace App\Http\Controllers;

use App\Jobs\ImportDataJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataImportController extends Controller {
    public function import(): JsonResponse {
        ImportDataJob::dispatch();

        return response()->json(['message' => 'Pobieranie danych rozpoczęte!']);
    }
}
