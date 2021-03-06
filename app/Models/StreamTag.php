<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamTag extends Model
{
    protected $fillable = [
        'stream_id',
        'tag_id',
    ];
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'tag_id');
    }
}
