<?php

namespace App\Repositories\Invite;

interface InviteInterface
{
    public function deleteBySurveyId($surveyId);

    public function delete($ids);

    public function invite($senderId, array $recevier, $surveyId, $numberAnswer = null);

    public function getResult($surveyId);
}
