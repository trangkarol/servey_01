<?php

namespace App\Repositories\Survey;

interface SurveyInterface
{
    public function getResutlSurvey($token);

    public function createSurvey($userId, $data, $status);

    public function updateSettingSurvey($survey, $data, $userRepo);

    public function updateSurveyByObject($survey, $values);

    public function updateSurvey($survey, $data, $status, $questionRepo, $answerRepo);

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

    //get survey by token
    public function getSurvey($token);

    //get section current
    public function getSectionCurrent($survey, $currentSection);

    public function deleteSurvey($survey);

    public function getAuthSurveys($role);

    public function countSurveyDraftOfUser($userId);

    public function closeSurvey($survey);

    public function openSurvey($survey);

    public function getOverviewSurvey($survey);

    public function getSurveyFromTokenManage($token_manage);

    public function getSurveyForResult($tokenManage);

    public function getSurveyFromToken($token);
}
