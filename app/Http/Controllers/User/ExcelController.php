<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use Excel;

class ExcelController extends Controller
{
    protected $surveyRepository;

    public function __construct(
        SurveyInterface $survey
    ) {
        $this->surveyRepository = $survey;
    }

    public function explore($token, $type)
    {
        $survey = $this->surveyRepository
            ->where('token', $token)
            ->first();

        if ($survey && ($type == config('survey.type_xls') || $type == config('survey.type_xlsx') )) {
            return Excel::create($survey->title, function($excel) use ($survey) {
                $excel->sheet($survey->title, function($sheet) use ($survey) {
                    $sheet->loadView('explore.excel', compact('survey'));
                    $sheet->setOrientation('landscape');
                });

                $excel->sheet('detail', function($sheet) use ($survey) {
                    $sheet->loadView('explore.detail', compact('survey'));
                    $sheet->setOrientation('landscape');
                });
            })->export($type);
        }
    }
}
