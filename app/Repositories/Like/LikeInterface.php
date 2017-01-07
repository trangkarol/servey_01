<?php

namespace App\Repositories\Like;

interface LikeInterface
{
    public function unlikeSurvey($userId, $surveyId);

    public function countLike($id);

    public function checkIsLike($userId, $surveyId);

    public function deleteBySurveyId($surveyId);
}
