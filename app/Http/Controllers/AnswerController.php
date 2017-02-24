<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\Survey\SurveyInterface;
use Auth;
use Carbon\Carbon;

class AnswerController extends Controller
{
    protected $surveyRepository;
    protected $inviteRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        InviteInterface $inviteRepository
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->inviteRepository = $inviteRepository;
    }

    protected function chart(array $inputs)
    {
        $result = [];

        foreach ($inputs as $key => $value) {
            $results[] = [
                'answer' => $value['content'],
                'percent' => $value['percent'],
            ];
        }

        return $results;
    }

    protected function viewChart($token)
    {
        $results = $this->surveyRepository->getResutlSurvey($token);
        $charts = [];

        if (!$results) {
            return [
                'charts' => null,
                'status' => false,
            ];
        }

        foreach ($results as $key => $value) {
            $charts[] = [
                'question' => $value['question'],
                'chart' => ($this->chart($value['answers'])) ?: null,
            ];
        }

        return [
            'charts' => $charts,
            'status' => true,
        ];
    }

    public function checkSurvey($surveyId, $deadline, $status, $type)
    {
        $date = $deadline->gt(Carbon::now());
        $flage = true;

        if (!$date || !$status) {
            return false;
        } elseif ($type == config('survey.private')) {
            $flage =  $this->inviteRepository
                ->where('recevier_id', auth()->id())
                ->where('survey_id', $surveyId)
                ->exists();
        }

        return $flage;
    }

    public function answer($token, $type)
    {
        $getCharts = $this->viewChart($token);
        $status = $getCharts['status'];
        $charts = $getCharts['charts'];
        $survey = $this->surveyRepository
            ->where('token', $token)
            ->first();

        if ($survey) {
            if ($survey->user_id == auth()->id()
                || $this->checkSurvey($survey->id, $survey->deadline, $survey->status, $type)
            ) {
                return view('user.pages.answer', [
                    'surveys' => $survey,
                    'status' => $status,
                    'charts' => $charts,
                ]);
            }
        }

        return redirect()->action('SurveyController@index')
            ->with('message-fail', trans('messages.permisstion',[
                'object' => class_basename(Invite::class),
            ]));
    }

    public function answerPublic($token)
    {
        return $this->answer($token, config('survey.public'));
    }

    public function answerPrivate($token)
    {
        return $this->answer($token, config('survey.private'));
    }
}
