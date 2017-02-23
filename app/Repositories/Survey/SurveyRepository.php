<?php

namespace App\Repositories\Survey;

use DB;
use Exception;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Like\LikeInterface;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\BaseRepository;
use App\Models\Survey;

class SurveyRepository extends BaseRepository implements SurveyInterface
{
    protected $likeRepository;
    protected $questionRepository;
    protected $inviteRepository;

    public function __construct(
        Survey $survey,
        QuestionInterface $question,
        LikeInterface $like,
        InviteInterface $invite
    ) {
        parent::__construct($survey);
        $this->likeRepository = $like;
        $this->inviteRepository = $invite;
        $this->questionRepository = $question;
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            $ids = is_array($ids) ? $ids : [$ids];
            $this->inviteRepository->deleteBySurveyId($ids);
            $this->likeRepository->deleteBySurveyId($ids);
            $this->questionRepository->deleteBySurveyId($ids);
            parent::delete($ids);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function getResutlSurvey($token)
    {
        $survey = $this->where('token', $token)->first();

        if (!$survey) {
            return false;
        }

        $dataInput = $this->inviteRepository->getResult($survey->id);
        $questions = $dataInput['questions'];
        $temp = [];
        $results = [];

        if (empty($dataInput['results']->toArray())) {
            return false;
        }

        foreach ($questions as $key => $question) {
            $answers = $dataInput['answers']->where('question_id', $question->id);

            foreach ($answers as $answer) {
                $total = $dataInput['results']
                    ->whereIn('answer_id', $answers->pluck('id')->toArray())
                    ->pluck('id')
                    ->toArray();
                $answerResult = $dataInput['results']
                    ->whereIn('answer_id', $answer->id)
                    ->pluck('id')
                    ->toArray();
                $temp[] = [
                    'answerId' => $answer->id,
                    'content' => ($answer->type == config('survey.type_time')
                        || $answer->type == config('survey.type_text')
                        || $answer->type == config('survey.type_date'))
                        ? $dataInput['results']->whereIn('answer_id', $answer->id)
                        : $answer->content,
                    'percent' => (count($total) > 0) ? (double)(count($answerResult) * 100) / (count($total)) : 0,
                ];
            }

            $results[] = [
                'question' => $question,
                'answers' => $temp,
            ];
            $temp = [];
        }

        return $results;
    }
}
