<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'sender_id',
        'recevier_id',
        'survey_id',
        'mail',
        'number_answer',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recevier()
    {
        return $this->belongsTo(User::class, 'recevier_id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
