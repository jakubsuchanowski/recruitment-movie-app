<?php

namespace App\Jobs;

use App\Models\Movie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Http;

class ImportDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $apiKey = config('app.tmdb.key');
        $movies = Http::get("https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}")->json()['results'];
        foreach ($movies as $movie) {
            Movie::updateOrCreate([
                'external_id' => $movie['id'],
                'title' => $movie['title'],
                'original_title' => $movie['original_title'],
                'original_language' => $movie['original_language'],
                'adult' => $movie['adult'],
                'vote_average' => $movie['vote_average'],
            ]);
        }       
    }
}
