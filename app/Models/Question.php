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
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value ?: config('settings.image_default');
    }

    public function getImageAttribute()
    {
        $questionImgUrl = config('settings.image_default');

        if ($this->attributes['image']) {
            $questionImgUrl = $this->attributes['image'];
        }

        return asset(config('settings.question_img_url' . $questionImgUrl);
    }
}
