<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Like\LikeInterface;
use Auth;

class LikeController extends Controller
{
    protected $surveyRepository;
    protected $likeRepository;

    public function __construct(
        LikeInterface $likeRepository,
        SurveyInterface $surveyRepository
    ) {
        $this->likeRepository = $likeRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function markLike(Request $request)
    {
        if (!$request->ajax()) {
            return [
                'success' => false,
            ];
        }

        $idSurvey = (int) $request->get('idSurvey');
        $value = (int) $request->get('value');

        if ($value == config('settings.mark')) {
            $survey = [
                'user_id' => Auth::user()->id,
                'survey_id' => $idSurvey,
            ];

            if ($this->likeRepository->create($survey)){
                return [
                    'success' => true,
                    'data' => config('settings.mark'),
                ];
            }

            return [
                'success' => false,
            ];

        } else {

            if ($this->likeRepository->unlikeSurvey(Auth::user()->id, $idSurvey)) {
                return [
                    'success' => true,
                    'data' => config('settings.unmark'),
                ];
            }

            return [
                'success' => false,
            ];
        }
    }
}
