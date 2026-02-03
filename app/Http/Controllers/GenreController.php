<?php

namespace App\Http\Controllers;

use App\Jobs\ImportGenreDataJob;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class GenreController extends Controller {
    public function index(Request $request): JsonResponse {
        $perPage = $request->query('per_page', 10);
        $genres = Genre::paginate($perPage);

        $data = $genres->map(fn($movie) => [
                'name' => $movie->translate('name'),
            ]);

        return response()->json([
            'current_page' => $genres->currentPage(),
            'data' => $data,
            'last_page' => $genres->lastPage(),
            'per_page' => $genres->perPage(),
            'total' => $genres->total(),
        ]);
    }

    public function import(): JsonResponse {
        try {
            ImportGenreDataJob::dispatch();
            return response()->json(['message' => 'Pobieranie gatunków zakończone sukcesem!'], 202);
         } catch (Throwable $e) {
            return response()->json([
                'message' => 'Nie udało się rozpocząć pobierania danych.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
