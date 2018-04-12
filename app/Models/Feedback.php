<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name',
        'email',
        'content',
        'status',
    ];

    public function getPartContentAttribute()
    {
        return str_limit($this->attributes['content'], config('settings.content_length_default'));
    }
}
