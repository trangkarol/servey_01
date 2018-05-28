<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use Exception;
use Auth;

class ResultController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function result(Request $request, $token)
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

            if (Auth::user()->cannot('view', $survey)) {
                return view('clients.layout.403');
            }

            $resultsSurveys = $this->surveyRepository->getResutlSurvey($survey);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('clients.survey.result.content_result', compact('survey', 'resultsSurveys'))->render(),
                ]);
            }

            return view('clients.survey.result.index', compact('survey', 'resultsSurveys'));
        } catch (Exception $e) {
            return view('clients.layout.404');
        }
    }
}
