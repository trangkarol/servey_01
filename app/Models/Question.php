<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'description',
        'required',
        'order',
        'update',
        'section_id',
    ];

    protected $appends = [
        'trim_content',
    ];

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function results()
    {
        return $this->hasManyThrough(Result::class, Answer::class);
    }

    public function answerResults()
    {
        return $this->hasMany(Result::class);
    }

    public function answers()
    {
        /*
        * Sort the answers of question with the answer orther radio or orther checkbox is last of the list answer in question
        * The config other checkbox will be larger than the type checkbox, orther radio will be larger than the type radio
        * Config radio and checkbox = [1, 2], config orther radio and orther checkbox = [5, 6]
        */
        return $this->hasMany(Answer::class);
    }

    public function duplicate($newQuestion)
    {
        $items = $this->answers;
        foreach ($items as $item) {
            $newQuestion->answers()->create($item->toArray());
        }
    }

    public function getImageAttribute()
    {
        if (empty($this->attributes['image'])) {
            return null;
        }

        $questionImgUrl = $this->attributes['image'];

        return asset(config('settings.image_question_path') . $questionImgUrl);
    }

    public function getTrimContentAttribute()
    {
        return (mb_strlen($this->attributes['content']) > 50) ? mb_substr($this->attributes['content'], 0, 50) . '...' : $this->attributes['content'];
    }
}
