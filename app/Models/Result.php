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

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getContentAnswerAttribute()
    {
        $answer = $this->answer;
        if ($answer && $answer->type == config('settings.answer_type.option')) {
            return $answer->content;
        }

        return $this->attributes['content'];
    }

    public function getUpperContentAttribute()
    {
        return strtoupper($this->attributes['content']);
    }
}
