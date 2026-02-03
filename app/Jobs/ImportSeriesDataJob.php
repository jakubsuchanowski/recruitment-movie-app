<?php

namespace App\Jobs;

use App\Models\Series;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Http;
use Log;


class ImportSeriesDataJob implements ShouldQueue {
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

        $response = Http::get("https://api.themoviedb.org/3/tv/popular", [
                'api_key' => $apiKey, 
                'language' => 'en-US', 
            ])->json()['results'];

        $response = array_splice($response, 0, 10);
        foreach ($response as $series) {
            $data = [];
            $seriesId = $series['id'];
            foreach ($lang as $key => $value) {
                $details = Http::get("https://api.themoviedb.org/3/tv/{$seriesId}", [
                        'api_key' => $apiKey, 
                        'language' => $value
                    ])->json(); 
                
                $data["name_{$key}"] = $details['name'] ?? ''; 
                $data["overview_{$key}"] = $details['overview'] ?? ''; }
                $data['vote_average'] = $item['vote_average'] ?? 0;
            Series::updateOrCreate(
                ['external_id' => $seriesId], $data); 
        }
    }
}
