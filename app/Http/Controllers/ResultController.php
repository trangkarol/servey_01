<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Survey\SurveyInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Invite\InviteInterface;
use Auth;
use DB;
use App\Http\Requests\AnswerRequest;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $surveyRepository;
    protected $inviteReposirory;

    public function __construct(
        ResultInterface $resultRepository,
        SurveyInterface $surveyRepository,
        InviteInterface $inviteReposirory
    ) {
        $this->resultRepository = $resultRepository;
        $this->surveyRepository = $surveyRepository;
        $this->inviteReposirory = $inviteReposirory;
    }

    public function result($token, AnswerRequest $request)
    {
        $isSuccess = false;
        $answers = $request->get('answer');
        $data = [];
        $recevier = $this->surveyRepository->where('token', $token)->first();
        $invite = $this->inviteReposirory
            ->where('recevier_id', auth()->id())
            ->where('survey_id', $recevier->id)
            ->where('number_answer', '>', 0)
            ->orWhere(function ($query) use ($recevier) {
                $query->where('survey_id', $recevier->id)
                    ->where('mail', (Auth::guard()->check()) ? Auth::user()->email : null)
                    ->where('number_answer', '>', 0);
            })
            ->first();

        if ($recevier->feature
            || (!$recevier->feature && Auth::guard()->check() && $invite)
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

            $isSuccess = true;
        }

        DB::beginTransaction();
        try {
            if (!empty($data)
                && $this->resultRepository->multiCreate($data)
                && $data[0]['sender_id'] != auth()->id()
            ) {
                $isSuccess = $this->inviteReposirory->update($recevier->id, [
                    'number_answer' => ($invite->number_answer) ? ($invite->number_answer--) : null,
                    'status' => config('survey.invite.old'),
                ]);
            }

            if (!$isSuccess) {
                throw new Exception;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()
            ->action('SurveyController@index')
            ->with(($isSuccess) ? 'message' : 'message-fail', ($isSuccess)
                ? trans('messages.object_created_successfully', [
                    'object' => class_basename(Answer::class),
                ])
                : trans('generate.permisstion', [
                    'object' => class_basename(Answer::class),
                ]));
    }
}
