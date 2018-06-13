<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Result\ResultInterface;
use App\Repositories\User\UserInterface;
use Exception;
use Auth;

class ResultController extends Controller
{
    protected $surveyRepository;
    protected $resultRepository;
    protected $userRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        ResultInterface $resultRepository,
        UserInterface $userRepository
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->resultRepository = $resultRepository;
        $this->userRepository = $userRepository;
    }

    public function result(Request $request, $tokenManage)
    {
        try {
            $survey = $this->surveyRepository->getSurveyForResult($tokenManage);

            if (Auth::user()->cannot('viewResult', $survey)) {
                return view('clients.layout.403');
            }

            $resultsSurveys = $this->surveyRepository->getResutlSurvey($survey, $this->userRepository);

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

    public function detail(Request $request, $tokenManage)
    {
        try {
            $survey = $this->surveyRepository->getSurveyForResult($tokenManage);

            if (Auth::user()->cannot('viewResult', $survey)) {
                return view('clients.layout.403');
            }

            $data = $this->resultRepository->getDetailResultSurvey($request, $survey, $this->userRepository);
            $details = $data['results'];
            $countResult = $data['countResult'];
            $pageCurrent = isset($request->page) ? $request->page : 1;

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('clients.survey.result.content-detail', compact([
                        'survey',
                        'countResult',
                        'details',
                        'pageCurrent',
                    ]))->render(),
                ]);
            }

            return view('clients.survey.result.detail', compact([
                'survey',
                'countResult',
                'details',
                'pageCurrent',
            ]));
        } catch (Exception $e) {

            return view('clients.layout.404');
        }
    }
}
