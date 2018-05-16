<?php

namespace App\Repositories\Survey;

interface SurveyInterface
{
    public function getResutlSurvey($token);

    public function createSurvey($userId, $data);

    public function checkCloseSurvey($inviteIds, $surveyIds);

    public function listsSurvey($userId, $email = null);

    public function getSettings($surveyId);

    public function getHistory($userId, $clientIp, $surveyId, array $options);

    public function getUserAnswer($token);

    public function getResultExport($survey);

    public function duplicateSurvey($survey);

    public function checkExist($token);

    public function getSurveyByTokenManage($token);

    public function getSurveysByStatus($status);

    public function getAuthSurveys();

    //get survey by token
    public function getSurvey($token);

    //get section current
    public function getSectionCurrent($survey, $currentSection);

    public function deleteSurvey($survey);
}
