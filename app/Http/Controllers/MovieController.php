<?php

namespace App\Http\Controllers;

use App\Jobs\ImportMovieDataJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Movie;
use Throwable;

class MovieController extends Controller {
    public function index(Request $request): JsonResponse {
        $perPage = $request->query('per_page', 10);
        $movies = Movie::paginate($perPage);

        $data = $movies->map(fn($movie) => [
                'title' => $movie->translate('title'),
                'overview' => $movie->translate('overview'),
                'vote_average' => $movie->vote_average,
            ]);

        return response()->json([
            'current_page' => $movies->currentPage(),
            'data' => $data,
            'last_page' => $movies->lastPage(),
            'per_page' => $movies->perPage(),
            'total' => $movies->total(),
        ]);
    }

    public function import(): JsonResponse {
        try {
            ImportMovieDataJob::dispatch();
            return response()->json(['message' => 'Pobieranie filmów zakończone sukcesem!'], 202);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Nie udało się rozpocząć pobierania danych.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
