<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, Storage, Exception;
use App\Repositories\Survey\SurveyInterface;
use App\Traits\ManageSurvey;

class ManagementSurvey extends Controller
{
    use ManageSurvey;

    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function getOverviewSurvey(Request $request, $tokenManage)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }
        
        $survey = $this->surveyRepository->getSurveyFromTokenManage($tokenManage); 
        $results = $this->getOverview($survey);

        $html = view('clients.survey.management.overview', compact('results'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }
}
