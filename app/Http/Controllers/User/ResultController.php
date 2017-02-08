<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Survey\SurveyInterface;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $surveyRepository;

    public function __construct(
        ResultInterface $resultRepository,
        SurveyInterface $surveyRepository
    ) {
        $this->resultRepository = $resultRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function result($token, Request $request)
    {
        $isSuccess = false;
        $answers = $request->get('answer');
        $data = [];
        $recevier = $this->surveyRepository->where('token', $token)->first();
        $check = $this->inviteReposirory
            ->where('recevier_id', auth()->id())
            ->where('survey_id', $recevier->id)
            ->orWhere(function ($query) use ($recevier) {
                $query->where('survey_id', $recevier->id)
                    ->Where('mail', Auth::user()->mail)
            })
            ->exists();

        if ($recevier->feature
            || (!$recevier->feature && Auth::user()->check() && $check))
            || auth()->id() == $recevier->user_id
        ) {

            foreach ($answers as $answer) {
                if (!is_array($answer)) {
                    $answer = [$answer => null];
                }

                foreach ($answer as $key => $value) {
                    $data[] = [
                        'sender_id' => (auth()->id()) ?: null,
                        'recevier_id' => $recevier->user_id,
                        'answer_id' => $key,
                        'content' => $value,
                    ];
                }
            }
        }

        if (!empty($data) && $this->resultRepository->multiCreate($data)) {
            $isSuccess = true;
        }

        return redirect()
            ->action('SurveyController@getHome')
            ->with('message', ($isSuccess)
                ? trans('messages.object_created_successfully', [
                    'object' => class_basename(Answer::class),
                ])
                : trans('messages.object_created_unsuccessfully', [
                    'object' => class_basename(Answer::class),
                ]));
    }
}

