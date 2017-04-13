<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'content',
        'type',
        'question_id',
        'image',
        'update',
        'clone_id',
        'video',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function results()
    {
         return $this->hasMany(Result::class);
    }

    public function getImageAttribute()
    {
        if (empty($this->attributes['image'])) {
            return null;
        }

        $answerImgUrl = $this->attributes['image'];

        return asset(config('settings.image_answer_path') . $answerImgUrl);
    }

    public function getImageUpdateAttribute()
    {
        return $this->attributes['image'];
    }

    public function scopeOfClone($query, $questionId)
    {
        if (!$this->clone_id) {
            return $query->where('question_id', $questionId)->where('clone_id', $this->id);
        }

        return $query
            ->newQuery($this)
            ->where('question_id', $questionId)
            ->where('clone_id', $this->clone_id)
            ->where('id', '>', $this->id);
    }
}
