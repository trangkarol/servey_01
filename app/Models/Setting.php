<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'survey_id',
        'key',
        'value',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
