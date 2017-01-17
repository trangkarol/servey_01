<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Survey\SurveyInterface;
use App\Mail\InviteSurvey;
use Mail;
use Auth;

use Illuminate\Contracts\Queue\ShouldQueue;
class SurveyController extends Controller
{
    protected $inviteRepository;
    protected $surveyRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        InviteInterface $inviteRepository
    ) {
        $this->inviteRepository = $inviteRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function index()
    {
        return $this->surveyRepository->where('feature', config(config('settings.feature')))->get();
    }

    public function show($token)
    {
        return $this->surveyRepository->where('token', $token)->first();
    }

    public function inviteUser(Request $request)
    {
        $isSuccess = false;

        if ($request->ajax()) {
            $data['emails'] = $request->get('emails');
            $data['survey'] = $request->get('surveyId');

            if ($data['emails'] && $data['survey']) {
                $survey = $this->surveyRepository->find($data['survey']);
                $invite = $this->inviteRepository->invite(auth()->id(), $data['emails'], $data['survey']);

                if ($invite) {
                    Mail::to($data['emails'])->queue(new InviteSurvey([
                        'senderName' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'title' => $survey->title,
                        'link' => action('SurveyController@answer', $survey->token),
                    ]));

                    $isSuccess = true;
                }
            }
        }

        return response()->json(['success' => $isSuccess]);
    }
}
