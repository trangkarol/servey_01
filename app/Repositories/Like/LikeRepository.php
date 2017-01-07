<?php

namespace App\Repositories\Like;

use App\Repositories\BaseRepository;
use DB;
use Exception;
use App\Models\Like;

class LikeRepository extends BaseRepository implements LikeInterface
{

    public function __construct(Like $like)
    {
        parent::__construct($like);
    }

    public function unlikeSurvey($userId, $surveyId)
    {
        DB::beginTransaction();
        try {
            $this->where('user_id', $userId)->where('survey_id', $surveyId)->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function countLike($id)
    {
        return $this->where('survey_id', $id)->count();
    }

    public function checkIsLike($userId, $surveyId)
    {
        return $this->where('user_id', $userId)->where('survey_id', $surveyId)->first();
    }

    public function deleteBySurveyId($surveyId)
    {
        $surveyId = is_array($surveyId) ? $surveyId : [$surveyId];
        parent::delete($this->whereIn('survey_id', $surveyId)->lists('id')->toArray());
    }
}
