<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'survey_id',
        'invite_mails',
        'answer_mails',
        'status',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
