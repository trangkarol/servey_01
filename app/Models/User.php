<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'gender',
        'phone',
        'address',
        'image',
        'status',
        'level',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value ?: config('settings.avatar_default');
    }

    public function getImageAttribute()
    {
        $userImgUrl = config('settings.avatar_default');

        if ($this->attributes['image']) {
            $userImgUrl = $this->attributes['image'];
        }

        return asset(config('settings.image_url' . $userImgUrl);
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setLevelAttributes($value)
    {
        $this->attributes['level'] = $value ?: config('settings.level_default');
    }

    public function setStatusAttributes($value)
    {
        $this->attributes['status'] = $value ?: config('settings.status_default');
    }

    public function reciveResults()
    {
        return $this->hasMany(Result::class, 'reciver_id');
    }

    public function sendResults()
    {
        return $this->hasMany(Result::class, 'sender_id');
    }

    public function reciveSurveys()
    {
        return $this->hasMany(Survey::class, 'reciver_id');
    }

    public function sendSurveys()
    {
        return $this->hasMany(Survey::class, 'sender_id');
    }
}
