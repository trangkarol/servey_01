<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key',
        'value',
        'settingable_id',
        'settingable_type',
    ];

    protected $dates = ['deleted_at'];

    public function settingable()
    {
        return $this->morphTo();
    }
}
