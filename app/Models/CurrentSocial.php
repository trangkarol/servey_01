<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentSocial extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
