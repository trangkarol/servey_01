<?php

namespace App\Repositories\Request;

use App\Repositories\BaseRepository;
use App\Models\Request;

class RequestRepository extends BaseRepository implements RequestInterface
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}
