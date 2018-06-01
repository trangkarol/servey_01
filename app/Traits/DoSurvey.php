<?php

namespace App\Traits;
use Auth, Session;

trait DoSurvey
{
    public function getDetailSurvey($survey, $numOfSection)
    {
        if (Auth::user()->cannot('view', $survey)) {
            return view('clients.layout.403');
        }
        
        Session::put('current_section_survey', config('settings.section_order_default'));
        $currentSection = config('settings.section_order_default');
        $section = $this->surveyRepository->getSectionCurrent($survey, $currentSection);

        return [
            'survey' => $survey,
            'section' => $section,
            'numOfSection' => $numOfSection,
            'currentSection' => $currentSection,
        ];
    }
}
