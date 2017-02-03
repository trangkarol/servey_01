<?php

namespace App\Repositories\Invite;

use App\Repositories\BaseRepository;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Question\QuestionInterface;
use App\Models\Invite;
use App\Repositories\User\UserInterface;
use DB;
use Exception;

class InviteRepository extends BaseRepository implements InviteInterface
{
    protected $answerRepository;
    protected $resultRepository;
    protected $questionRepository;
    protected $userRepository;

    public function __construct(
        Invite $invite,
        AnswerInterface $answerRepository,
        ResultInterface $resultRepository,
        QuestionInterface $questionRepository,
        UserInterface $userRepository
    ) {
        parent::__construct($invite);
        $this->answerRepository = $answerRepository;
        $this->resultRepository = $resultRepository;
        $this->questionRepository = $questionRepository;
        $this->userRepository = $userRepository;
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

    public function invite($senderId, array $recevier, $surveyId)
    {
        DB::beginTransaction();
        try {
            $usersAvailable = $this->userRepository->whereIn('email', $recevier)->lists('email', 'id');
            $inputsAvailable = [];

            foreach ($usersAvailable as $id => $email) {
                $inputsAvailbale[] = [
                    'sender_id' => $senderId,
                    'recevier_id' => $id,
                    'survey_id' => $surveyId,
                ];
            }

            $users = array_diff($recevier, $usersAvailable->toArray());
            $inputsUser = [];

            foreach ($users as $user) {
                $inputsUser[] = [
                    'sender_id' => $senderId,
                    'survey_id' => $surveyId,
                    'mail' => $user,
                ];
            }

            if ($this->multiCreate($inputsUser) && $this->multiCreate($inputsAvailable)) {
                DB::commit();

                return true;
            }
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
