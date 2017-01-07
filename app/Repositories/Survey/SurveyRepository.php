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
}
