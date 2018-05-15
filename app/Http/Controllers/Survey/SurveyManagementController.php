<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Auth;
use Datatables;
use User;
use Session;
use DB;
use Storage;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\Media\MediaInterface;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Section;

class SurveyManagementController extends Controller
{
    protected $surveyRepository;
    protected $sectionRepository;
    protected $questionRepository;
    protected $answerRepository;
    protected $settingRepository;
    protected $mediaRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        QuestionInterface $questionRepository,
        SectionInterface $sectionRepository,
        AnswerInterface $answerRepository,
        SettingInterface $settingRepository,
        MediaInterface $mediaRepository
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->questionRepository = $questionRepository;
        $this->sectionRepository = $sectionRepository;
        $this->answerRepository = $answerRepository;
        $this->settingRepository = $settingRepository;
        $this->mediaRepository = $mediaRepository;
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

    public function delete($token)
    {
        DB::beginTransaction();
        try {
            $survey = $this->surveyRepository->where('token_manage', $token)->first();

            if (Auth::user()->cannot('delete', $survey)) {
                return view('clients.layout.403');
            }

            $this->sectionRepository->deleteSections($survey->sections->pluck('id')->all());
            $this->surveyRepository->deleteSurvey($survey);
            DB::Commit();

            return back()->with('delete_survey_success', trans('lang.delete_survey_success'));
        } catch (Exception $e) {
            DB::rollback();

            return back()->with('delete_survey_fail', trans('lang.delete_survey_fail'));
        }
    }

    public function closeSurvey($token)
    {
        $survey = $this->surveyRepository->where('token_manage', $token)->first();

        if (Auth::user()->cannot('close', $survey)) {
            return view('clients.layout.403');
        }

        $survey->delete();

        return back()->with('close_survey_success', trans('lang.close_survey_success'));
    }
}
