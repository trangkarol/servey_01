<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use Exception;

class ResultController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function result($token)
    {
        try {
            $survey = $this->surveyRepository->where('token', $token)->with([
                'sections.questions' => function ($query) {
                    $query->with([
                        'settings',
                        'results',
                        'answers' => function ($queryAnswer) {
                            $queryAnswer->with([
                                'settings',
                            ]);
                        }
                    ]);
                }])->first();

            $resultsSurveys = $this->surveyRepository->getResutlSurvey($survey);

            return view('clients.survey.result.index', compact('survey', 'resultsSurveys'));
        } catch (Exception $e) {
            return view('clients.layout.404');
        }
    }
}
