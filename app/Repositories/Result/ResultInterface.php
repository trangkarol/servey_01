<?php

namespace App\Repositories\Result;

interface ResultInterface
{
    public function create($answers);

    public function storeResult($data, $survey);

    public function closeFromSurvey($survey);

    public function openFromSurvey($survey);

    public function deleteFromSurvey($survey);
}
