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

    protected $appends = [
        'trim_content',
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

    public function getNameTypeAttribute()
    {
        switch ($this->attributes['type']) {
            case config('survey.type_radio'):
                return trans('temp.one_choose');
            case config('survey.type_checkbox'):
                return trans('temp.multi_choose');
            case config('survey.type_text'):
                return trans('temp.text');
            case config('survey.type_date'):
                return trans('temp.date');
            case config('survey.type_time'):
                return trans('temp.time');
            default:
                break;
        }
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

    public function getTrimContentAttribute($value='')
    {
        return (strlen($this->attributes['content']) > 50) ? substr($this->attributes['content'], 0, 50). '...' : $this->attributes['content'];
    }
}
