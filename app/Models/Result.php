<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'answer_id',
        'user_id',
        'content',
        'client_ip',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
