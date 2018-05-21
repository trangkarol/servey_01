<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Model
{
    use SoftDeletes;

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

    protected $dates = ['deleted_at'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
