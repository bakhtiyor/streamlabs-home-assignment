<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_id',
        'localization_names',
        'localization_descriptions'
    ];
}
