<?php

namespace App\Traits;
use Auth, Session;

trait DoSurvey
{
    public function getDetailSurvey($survey, $numOfSection)
    {
        Session::put('current_section_survey', config('settings.section_order_default'));
        $currentSection = config('settings.section_order_default');
        $sectionsId = $survey->sections->sortBy('order')->pluck('id')->all();
        $section = $this->surveyRepository->getSectionCurrent($survey, $sectionsId[$currentSection - 1]);

        return [
            'survey' => $survey,
            'section' => $section,
            'numOfSection' => $numOfSection,
            'currentSection' => $currentSection,
        ];
    }
}
