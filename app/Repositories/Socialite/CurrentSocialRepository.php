<?php

namespace App\Repositories\Socialite;

use App\Models\CurrentSocial;
use App\Repositories\Socialite\CurrentSocialInterface;
use App\Repositories\BaseRepository;

class CurrentSocialRepository extends BaseRepository
{
    public function __construct(CurrentSocial $model)
    {
        parent::__construct($model);
    }
}
