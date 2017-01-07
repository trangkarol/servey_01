<?php

namespace App\Repositories\Invite;

interface InviteInterface
{
    public function deleteBySurveyId($surveyId);

    public function delete($ids);
}
