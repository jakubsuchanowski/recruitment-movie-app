<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    protected $fillable = [
        'external_id',
        'title',
        'original_title',
        'original_language',
        'adult',
        'vote_average',
    ];

    protected $casts = [
        'adult' => 'boolean',
        'vote_average' => 'float',
    ];
}
