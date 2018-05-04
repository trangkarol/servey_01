<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Survey extends Model
{
    const OWNER = 0;
    const APPROVE = 1;

    protected $fillable = [
        'title',
        'description',
        'token',
        'status',
        'end_time',
        'start_time',
        'update',
        'feature',
        'token_manage',
    ];

    protected $appends = [
        'status_custom',
    ];

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'members', 'survey_id', 'user_id')
            ->withPivot('role', 'status')
            ->withTimestamps();
    }

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }

    public function setStartTimeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['start_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
        }
    }

    public function setEndTimeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['end_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
        }
    }

    // public function getIsOpenAttribute()
    // {
    //     return (empty($this->attributes['deadline']) || Carbon::parse($this->attributes['deadline'])->gt(Carbon::now()));
    // }

    public function getTitleAttribute()
    {
        return ucwords(str_limit($this->attributes['title'], config('settings.title_length_default')));
    }

    // public function getIsExpiredAttribute()
    // {
    //     return empty($this->attributes['deadline']) ? false : $this->attributes['deadline'] <= Carbon::now()->toDateTimeString();
    // }

    public function getStatusCustomAttribute()
    {
        switch ($this->attributes['status']) {
            case config('survey.status.public'):
                return trans('profile.public');

            case config('survey.status.private'):
                return trans('profile.private');

            case config('survey.status.closed'):
                return trans('profile.closed');

            default:
                return trans('profile.draft');
        }
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format(trans('lang.date_format'));
    }

    public function getMemberListAttribute()
    {
        $members = $this->members;
        $memberList = '';

        foreach ($members as $member) {
            $memberList .= $member->email . ',' . $member->pivot->role . '/';
        }

        return $memberList;
    }

    public function getSetting($key = 0)
    {
        $settings = $this->settings;
        $filtered = $settings->whereIn('key', $key)->all();

        if (count($filtered)) {
            return current($filtered)->value;
        }

        return config('settings.survey_setting.default');
    }
}
