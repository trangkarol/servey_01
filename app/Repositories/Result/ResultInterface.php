<?php

namespace App\Repositories\Result;

interface ResultInterface
{
    public function create($answers);

    public function storeResult($data, $survey);
}
