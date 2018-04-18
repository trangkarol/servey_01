<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Auth;
use Datatables;
use User;
use Session;
use App\Repositories\Survey\SurveyInterface;

class SurveyManagementController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function showSurveys()
    {
        try {
            $user = Auth::user();
            Session::put('page_profile_active', config('settings.page_profile_active.list_survey'));

            return view('clients.profile.list-survey', compact('user'));
        } catch (Exception $e) {
            return view('clients.layout.404');
        }
    }

    public function getSurveys(Request $request)
    {
        $surveys = $this->surveyRepository->getAuthSurveys();

        return Datatables::of($surveys)->make(true);
    }
}
