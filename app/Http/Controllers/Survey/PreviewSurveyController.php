<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\SurveyProcesser;

class PreviewSurveyController extends Controller
{
    use SurveyProcesser;

    public function getJson(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $data = $request->data;
        $request->Session()->put('data-preview', $data);

        return response()->json([
            'success' => true,
            'json' => $data,
        ]);
    }

    public function show()
    {
        $survey = json_decode(Session::get('data-preview'));
        $numOfSection = count($survey->sections);

        $this->reloadPage('current_section', $numOfSection + config('settings.number_1'), config('settings.number_0'));

        $currentSection = Session::get('current_section');
        $section = $survey->sections[$currentSection];

        return view('clients.survey.create.preview', compact([
                'survey',
                'numOfSection',
                'section',
                'currentSection',
            ])
        );
    }

    public function nextSection()
    {
        $currentSection = Session::get('current_section');
        Session::put('current_section', ++ $currentSection);

        return redirect()->route('survey.create.preview');
    }

    public function previousSection()
    {
        $currentSection = Session::get('current_section');
        Session::put('current_section', -- $currentSection);

        return redirect()->route('survey.create.preview');
    }
}
