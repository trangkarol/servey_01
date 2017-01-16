<?php

namespace App\Repositories\Answer;

interface AnswerInterface
{
    public function deleteByQuestionId($questionIds);

    public function delete($ids);
}
