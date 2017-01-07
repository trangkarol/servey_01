<?php

namespace App\Repositories\Invite;

use App\Repositories\BaseRepository;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Question\QuestionInterface;
use App\Models\Invite;
use DB;
use Exception;

class InviteRepository extends BaseRepository implements InviteInterface
{
    protected $answerRepository;
    protected $resultRepository;
    protected $questionRepository;

    public function __construct(
        Invite $invite,
        AnswerInterface $answer,
        ResultInterface $result,
        QuestionInterface $question
    ) {
        parent::__construct($invite);
        $this->answerRepository = $answer;
        $this->resultRepository = $result;
        $this->questionRepository = $question;
    }

    public function deleteBySurveyId($surveyId)
    {
        $surveyId = is_array($surveyId) ? $surveyId : [$surveyId];
        parent::delete($this->whereIn('survey_id', $surveyId)->lists('id')->toArray());
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            $ids = is_array($ids) ? $ids : [$ids];
            $invite = $this->whereIn('id', $ids)->get();
            $senderId = $invite->recevier_id;
            $surveyId = $invite->survey_id;
            $questions = $this->questionRepository
                ->where('survey_id', $surveyId)
                ->lists('id')
                ->toArray();
            $answerIds = $this->answerRepository
                ->whereIn('question_id', $questions)
                ->lists('id')
                ->toArray();
            $this->resultRepository
                ->where('sender_id', $senderId)
                ->whereIn('answer_id', $answerIds)
                ->delete();
            parent::delete($ids);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
