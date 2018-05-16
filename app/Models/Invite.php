<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    const NOT_DONE = 0;

    protected $fillable = [
        'survey_id',
        'invite_mails',
        'answer_mails',
        'subject',
        'message',
        'status',
        'number_invite',
        'number_answer',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
