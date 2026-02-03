<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Series extends Model {
    use HasTranslations;

    protected $fillable = [
        'external_id',
        'name_pl',
        'name_en',
        'name_de',
        'overview_pl',
        'overview_en',
        'overview_de',
        'vote_average',
    ];
}
