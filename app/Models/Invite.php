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
        'send_update_mails',
        'subject',
        'message',
        'status',
        'number_invite',
        'number_answer',
    ];

    protected $dates = ['deleted_at'];

    protected $appends = [
        'invite_mails_array',
        'answer_mails_array',
        'send_update_mails_array',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function getInviteMailsArrayAttribute()
    {
        return !empty($this->attributes['invite_mails']) ? 
            array_filter(explode('/', $this->attributes['invite_mails'])) : [];
    }

    public function getAnswerMailsArrayAttribute()
    {
        return !empty($this->attributes['answer_mails']) ? 
            array_filter(explode('/', $this->attributes['answer_mails'])) : [];
    }

    public function getSendUpdateMailsArrayAttribute()
    {
        return !empty($this->attributes['send_update_mails']) ?
            array_filter(explode('/', $this->attributes['send_update_mails'])) : [];
    }
}
