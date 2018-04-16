<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use Session;
use App\Traits\SurveyProcesser;

class FormSurveyController extends Controller
{
    use SurveyProcesser;

    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    //show form survey
    public function getSurvey($token)
    {
        $survey = $this->surveyRepository->getSurvey($token);
        $numOfSection = $survey->sections()->count();

        $this->reloadPage('current_section_survey', $numOfSection, config('settings.section_order_default'));

        $currentSection = Session::get('current_section_survey');
        $section = $this->surveyRepository->getSectionCurrent($survey, $currentSection);

        return view('clients.survey.create.survey', compact([
                'survey',
                'section',
                'numOfSection',
                'currentSection',
            ])
        );
    }

    //next session form survey
    public function nextSectionSurvey($token)
    {
        $currentSection = Session::get('current_section_survey');
        Session::put('current_section_survey', ++ $currentSection);

        return redirect()->route('survey.create.do-survey', $token);
    }

    //prev session form survey
    public function previousSectionSurvey($token)
    {
        $currentSection = Session::get('current_section_survey');
        Session::put('current_section_survey', -- $currentSection);

        return redirect()->route('survey.create.do-survey', $token);
    }
}
