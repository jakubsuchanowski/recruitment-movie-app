<?php

namespace App\Http\Controllers;

use App\Jobs\ImportSeriesDataJob;
use App\Models\Series;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SeriesController extends Controller {
    public function index(Request $request): JsonResponse {
        $perPage = $request->query('per_page', 10);

        return response()->json(
            Series::paginate($perPage)
        );
    }

    public function import(): JsonResponse {
        try {
            ImportSeriesDataJob::dispatch();
            return response()->json(['message' => 'Pobieranie seriali zakończone sukcesem!'], 202);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Nie udało się rozpocząć pobierania danych.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
