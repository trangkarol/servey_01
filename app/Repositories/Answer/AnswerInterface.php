<?php

namespace App\Repositories\Answer;

use Illuminate\Support\Collection;

interface AnswerInterface
{
    public function deleteByQuestionId($questionIds);

    public function getAnswerIds($questionIds, $update = false);

    public function getResultByAnswer($questionIds, $time = null, $isUpdate = false);

    public function createOrUpdateAnswer(array $answers, array $data);

    public function deleteAnswers($ids);
}
