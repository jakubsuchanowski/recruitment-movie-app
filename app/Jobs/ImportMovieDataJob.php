<?php

namespace App\Jobs;

use App\Models\Movie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Http;

class ImportMovieDataJob implements ShouldQueue {
    use Queueable;
    /**
     * Execute the job.
     */
    public function handle(): void {
        $apiKey = config('app.tmdb.key');
        $movies = [];
        $lang = [
            'pl' => 'pl-PL', 
            'en' => 'en-US', 
            'de' => 'de-DE'
        ];

        for ($i = 1; $i <= 3; $i++) {
            $response = Http::get("https://api.themoviedb.org/3/movie/popular", [
                    'api_key' => $apiKey,
                    'page' => $i,
                    'language' => 'en-US'
                ])->json();

                $movies = array_merge($movies, $response['results']);
        }

        $movies = array_slice($movies, 0, 50);

        foreach ($movies as $movie) {
            $data = [];
            $movieId = $movie['id'];
            foreach ($lang as $key => $value) {
                $details = Http::get("https://api.themoviedb.org/3/movie/{$movieId}", [
                        'api_key' => $apiKey, 
                        'language' => $value
                    ])->json();
                $data['title_' . $key] = $details['title'] ?? '';
                $data['overview_' . $key] = $details['overview'] ?? '';

            }
            $data['vote_average'] = $movie['vote_average'] ?? '';
            Movie::updateOrCreate(['external_id' => $movie['id']], $data);  
        }       
    }
}
