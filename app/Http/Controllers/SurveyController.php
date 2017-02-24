<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Like\LikeInterface;
use Khill\Lavacharts\Lavacharts;
use App\Mail\InviteSurvey;
use Carbon\Carbon;
use Mail;
use Auth;
use DB;

class SurveyController extends Controller
{
    protected $surveyRepository;
    protected $questionRepository;
    protected $answerRepository;
    protected $inviteRepository;
    protected $likeRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        QuestionInterface $questionRepository,
        AnswerInterface $answerRepository,
        InviteInterface $inviteRepository
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->inviteRepository = $inviteRepository;
    }

    public function index()
    {
        return view('user.pages.home');
    }

    public function listSurveyUser()
    {
        $invites = $this->inviteRepository
            ->where('recevier_id', auth()->id())
            ->paginate(config('settings.paginate'));
        $surveys = $this->surveyRepository
            ->where('user_id', auth()->id())
            ->paginate(config('settings.paginate'));

        return view('user.pages.list-survey', compact('surveys', 'invites'));
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $idSurvey = $request->get('idSurvey');
            $this->surveyRepository->delete($idSurvey);

            return [
                'success' => true,
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function detailSurvey($token)
    {
        $surveys = $this->surveyRepository->where('token', $token)->first();

        return $surveys;
    }

    public function show($token)
    {
        $surveys = $this->detailSurvey($token);

        return view('user.pages.answer', compact('surveys'));
    }

    public function create(Request $request)
    {
        $value = $request->only([
            'title',
            'feature',
            'deadline',
            'description',
            'txt-question',
            'checkboxRequired',
            'email',
            'emails',
            'number_answer',
        ]);

        if (!strlen($value['title'])) {
            $value['title'] = config('survey.title_default');
        }

        $token = md5(uniqid(rand(), true));
        DB::beginTransaction();
        try {
            $survey = $this->surveyRepository
                ->create([
                    'user_id' => (Auth::guard()->check()) ? auth()->id() : null,
                    'mail' => (!Auth::guard()->check()) ? $value['email'] : null,
                    'title' => $value['title'],
                    'feature' => ($value['feature']) ? config('settings.not_feature') : config('settings.feature'),
                    'token' => $token,
                    'status' => ($value['deadline']) ? config('survey.status.avaiable') : config('survey.status.always'),
                    'deadline' => Carbon::parse($value['deadline'])->format('Y/m/d H:i'),
                    'description' => ($value['description']) ? : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            $txtQuestion = $value['txt-question'];
            $questions = $txtQuestion['question'];
            $answers = $txtQuestion['answers'];
            $questionRequired = $value['checkboxRequired'];

            if ($survey) {
                $this->questionRepository
                    ->createMultiQuestion($survey, $questions, $answers, $questionRequired['question']);
                $isSuccess = $this->inviteUser($request, $survey, config('settings.return.bool'));

                if (!$isSuccess) {
                    DB::rollback();

                    return redirect()->action('SurveyController@index')
                        ->with('message-fail', trans('messages.object_created_unsuccessfully', [
                            'object' => class_basename(Survey::class),
                        ]));
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->action('SurveyController@index')
                ->with('message-fail', trans('messages.object_created_unsuccessfully', [
                            'object' => class_basename(Survey::class),
            ]));
        }

        return view('user.pages.complete', [
            'token' => $token,
            'feature' => $value['feature'],
        ]);
    }

    public function inviteUser(Request $request, $surveyId, $type)
    {
        $isSuccess = false;
        $data['name'] = $request->get('name');
        $data['email'] = $request->get(($type == config('settings.return.bool')) ? 'email' : 'emailUser');
        $data['emails'] = $request->get(($type == config('settings.return.bool')) ? 'emails' : 'emailsUser');
        $data['number_answer'] = $request->get('number_answer');

        if (empty($data['emails'])) {
            return true;
        }

        $data['emails'] = explode(',', $data['emails']);

        if ($data['emails'] && $surveyId) {
            $survey = $this->surveyRepository->find($surveyId);
            $invite = $this->inviteRepository
                ->invite(auth()->id(), $data['emails'], $surveyId, $data['number_answer']);

            if ($invite) {
                Mail::to($data['emails'])->queue(new InviteSurvey([
                    'senderName' => (Auth::guard()->check()) ? Auth::user()->name : $data['name'],
                    'email' => (Auth::guard()->check()) ? Auth::user()->email : $data['email'],
                    'title' => $survey->title,
                    'link' => action(($survey->feature)
                        ? 'AnswerController@answerPrivate'
                        : 'AnswerController@answerPublic', [
                            'token' => $survey->token,
                    ]),
                ]));

                $isSuccess = true;
            }
        }

        return ($type == config('setttings.return.bool')) ? $isSuccess : ($isSuccess)
            ? redirect()->action('SurveyController@listSurveyUser')
                ->with('message', trans('survey.invite_success'))
            : redirect()->action('SurveyController@listSurveyUser')
                ->with('message-fail', trans('survey.invite_fail'));
    }

    public function updateSurvey(Request $request, $id)
    {
        $survey = $this->surveyRepository->find($id);
        $isSuccess = false;
        $data = $request->only([
            'title',
            'description',
            'deadline',
        ]);

        if ($survey) {
            DB::beginTransaction();
            try {
                $isSuccess = $this->surveyRepository->update($id, $data);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return redirect()->action('')
            ->with(($isSuccess) ? 'message' : 'message-fail', ($isSuccess)
                ? trans('messages.object_updated_successfully', [
                    'object' => class_basename(Survey::class),
                ])
                : trans('messages.object_updated_unsuccessfully',[
                    'object' => class_basename(Survey::class)
                ])
            );
    }

    public function showDetail($token)
    {
        $survey = $this->detailSurvey($token);

        return view('user.pages.detail-survey', compact('survey'));
    }
}
