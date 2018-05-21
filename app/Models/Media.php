<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'url',
        'mediable_id',
        'mediable_type',
    ];

    protected $dates = ['deleted_at'];

    public function mediable()
    {
        return $this->morphTo();
    }
}
