<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;

class ResultController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function result($token)
    {
        $survey = $this->surveyRepository->where('token', $token)->first();
        $resultsSurveys = $this->surveyRepository->getResutlSurvey($token);

        return view('clients.survey.result.index', compact('survey', 'resultsSurveys'));
    }
}
