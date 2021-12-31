<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'user_login',
        'user_name',
        'game_id',
        'game_name',
        'type',
        'title',
        'viewer_count',
        'started_at',
        'language',
        'thumbnail_url',
        'is_mature',
    ];

    public function tags()
    {
        return $this->hasMany(StreamTag::class);
    }

    public function userStreams()
    {
        return $this->hasMany(UserStream::class);
    }
}
