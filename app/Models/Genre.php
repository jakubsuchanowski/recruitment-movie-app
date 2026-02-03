<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Genre extends Model {
    use HasTranslations;

    protected $fillable = [
        'external_id',
        'name_pl',
        'name_en',
        'name_de',
    ];
}
