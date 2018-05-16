<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;

class SurveyController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function getListSurvey(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }
        
        $flag = $request->flag;
        $data = $request->only('name', 'status', 'privacy');
        $surveys = $this->surveyRepository->getAuthSurveys($flag, $data);
        $html = view('clients.profile.survey.list_survey_owner', compact('surveys'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }
}
