<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\SurveyProcesser;
use Exception;

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

    public function preview()
    {
        try {
            if (Session::has('current_section')) {
                Session::forget('current_section');
            }

            if (!Session::has('data-preview')) {
                throw new Exception("Not found data", 1);
            }

            return redirect()->route('survey.create.show');
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function show()
    {
        try {
            if (!Session::has('data-preview')) {
                throw new Exception("Not found data", 1);
            }
            
            $survey = json_decode(Session::get('data-preview'));
            $numOfSection = count($survey->sections);

            $this->reloadPage('current_section', $numOfSection, config('settings.number_0'));

            $currentSection = Session::get('current_section');
            $section = $survey->sections[$currentSection];

            return view('clients.survey.create.preview', compact([
                    'survey',
                    'numOfSection',
                    'section',
                    'currentSection',
                ])
            );
        } catch (Exception $e) {
            return redirect()->route('404');
        }
    }

    public function nextSection()
    {
        $currentSection = Session::get('current_section');
        Session::put('current_section', ++ $currentSection);

        return redirect()->route('survey.create.show');
    }

    public function previousSection()
    {
        $currentSection = Session::get('current_section');
        Session::put('current_section', -- $currentSection);

        return redirect()->route('survey.create.show');
    }
}
