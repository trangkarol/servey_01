<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'tittle',
        'description',
        'survey_id',
        'order',
    ];

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
