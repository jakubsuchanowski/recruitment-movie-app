<?php

namespace App\Jobs;

use App\Models\Genre;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Http;

class ImportGenreDataJob implements ShouldQueue {
    use Queueable;
    /**
     * Execute the job.
     */
    public function handle(): void {
        $apiKey = config('app.tmdb.key');
        $lang = [
            'pl' => 'pl-PL', 
            'en' => 'en-US', 
            'de' => 'de-DE'
        ];

        $genres = [];
        
        foreach ($lang as $key => $value) {
            $responseSeriesGenres = Http::get("https://api.themoviedb.org/3/genre/tv/list", [
                    'api_key' => $apiKey, 
                    'language' => $value
                ])->json()['genres'];

            $responseMovieGenres = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
                    'api_key' => $apiKey, 
                    'language' => $value
                ])->json()['genres'];
            
            foreach (array_merge($responseSeriesGenres, $responseMovieGenres) as $genre) {
                    $genres[$genre['id']]["name_{$key}"] = $genre['name'];
                }
        }

        foreach ($genres as $externalId => $data) {
            Genre::updateOrCreate(
                ['external_id' => $externalId], $data);  
        }       
    }
}
