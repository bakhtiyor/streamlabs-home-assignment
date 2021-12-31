<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStream extends Model
{
    protected $fillable = [
        'stream_id',
        'user_id',
    ];
    public $timestamps = false;
}
