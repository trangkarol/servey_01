<?php

namespace App\Repositories\Answer;

interface AnswerInterface
{
    public function deleteByQuestionId($questionIds);

    public function delete($ids);

    public function getAnswerIds($questionIds);

    public function getResultByAnswer($questionIds, $time = null);

    public function createOrUpdateAnswer(
        $questionId,
        collection $answersInQuestion,
        collection $collectAnswer,
        array $imagesAnswer,
        array $answers,
        array $removeAnswerIds,
        $isDelete,
        array $deleteImageIds
    );
}
