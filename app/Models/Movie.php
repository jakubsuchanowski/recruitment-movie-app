<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Movie extends Model {
    use HasTranslations;

    protected $fillable = [
        'external_id',
        'title_pl',
        'title_en',
        'title_de',
        'overview_pl',
        'overview_en',
        'overview_de',
        'vote_average',
    ];

    protected $casts = [
        'vote_average' => 'float',
    ];
}
