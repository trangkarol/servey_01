<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use Excel;
use PDF;

class ExportController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $survey)
    {
        $this->surveyRepository = $survey;
    }

    public function export($id, $type)
    {
        $survey = $this->surveyRepository->find($id);

        if(!$survey || !$type) {
            return false;
        }

        if ($survey && $type == 'excel') {
            return Excel::create($survey->title, function($excel) use ($survey) {
                $excel->sheet($survey->title, function($sheet) use ($survey) {
                    $sheet->loadView('explore.excel', compact('survey'));
                    $sheet->setOrientation('landscape');
                });
            })->export('xls');
        } else {
            return PDF::loadView('explore.PDF', compact('survey'))->download($survey->title . '.pdf');
        }
    }
}
