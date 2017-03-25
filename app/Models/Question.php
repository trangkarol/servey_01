<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'content',
        'image',
        'required',
        'survey_id',
        'sequence',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        /*
        * Sort the answers of question with the answer orther radio or orther checkbox is last of the list answer in question
        * The config other checkbox will be larger than the type checkbox, orther radio will be larger than the type radio
        * Config radio and checkbox = [1, 2], config orther radio and orther checkbox = [5, 6]
        */
        return $this->hasMany(Answer::class)->orderBy('type');
    }

    public function getImageAttribute()
    {
        if (empty($this->attributes['image'])) {
            return null;
        }

        $questionImgUrl = $this->attributes['image'];

        return asset(config('settings.image_question_path') . $questionImgUrl);
    }
}
