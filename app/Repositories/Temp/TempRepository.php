<?php

namespace App\Repositories\Temp;

use App\Models\Temp;
use App\Repositories\BaseRepository;

class TempRepository extends BaseRepository implements TempInterface
{
    public function __construct(Temp $temp)
    {
        parent::__construct($temp);
    }

    public function findByUserId($userId)
    {
        return $this->where('user_id', $userId)->orderBy('id', 'desc');
    }
}
