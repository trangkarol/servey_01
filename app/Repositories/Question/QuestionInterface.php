<?php

namespace App\Repositories\Question;

interface QuestionInterface
{
    public function deleteBySurveyId($surveyId);

    public function createMultiQuestion(
        $survey,
        $questions,
        $answers,
        $image,
        $imageUrl,
        $videoUrl,
        $required = null
    );

    public function getQuestionIds($surveyId);

    public function getResultByQuestionIds($surveyId, $time = null);

    public function updateSurvey(array $inputs, $surveyId);

    public function deleteFromSectionId($idSections);

    public function closeFromSectionId($idSections);
    
    public function openFromSectionId($idSections);

    public function deleteQuestionsById($idQuestions);

    public function cloneQuestion($question, $newSection);
}
