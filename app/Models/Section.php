<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'survey_id',
        'order',
        'update',
    ];

    protected $dates = ['deleted_at'];

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
