<?php

namespace App\Repositories\Question;

use App\Repositories\Answer\AnswerInterface;
use App\Repositories\BaseRepository;
use DB;
use Exception;
use App\Models\Question;

class QuestionRepository extends BaseRepository implements QuestionInterface
{
    protected $answerRepository;

    public function __construct(
        Question $question,
        AnswerInterface $answer
    ) {
        parent::__construct($question);
        $this->answerRepository = $answer;
    }

    public function deleteBySurveyId($surveyIds)
    {
        $ids = is_array($surveyIds) ? $surveyIds : [$surveyIds];
        $questions = $this->whereIn('survey_id', $ids)->lists('id')->toArray();
        $this->answerRepository->deleteByQuestionId($questions);
        parent::delete($questions);
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            $ids = is_array($ids) ? $ids : [$ids];
            $this->answerRepository->deleteByQuestionId($ids);
            parent::delete($ids);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
