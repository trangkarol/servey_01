<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Invite\InviteInterface;
use App\Mail\InviteSurvey;
use Mail;
use Auth;

class SurveyController extends Controller
{
    protected $surveyRepository;
    protected $questionRepository;
    protected $answerRepository;
    protected $inviteRepository;

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

    public function getHome()
    {
        $surveys = $this->surveyRepository
            ->where('feature', config('settings.survey.feature'))
            ->orderBy('id', 'desc')
            ->paginate(config('settings.paginate'));

        return view('user.pages.home-user', compact('surveys'));
    }

    public function register()
    {
        $surveys = $this->surveyRepository
            ->where('feature', config('settings.survey.feature'))
            ->orderBy('id', 'desc')
            ->paginate(config('settings.paginate'));

        return view('user.pages.register', compact('surveys'));
    }

    public function listSurveyUser()
    {
        $surveys = $this->surveyRepository
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(config('settings.paginate'));

        return view('user.pages.home-user', compact('surveys'));
    }

    public function createSurvey()
    {
        return view('survey.create');
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

    public function show($token)
    {
        $surveys = $this->surveyRepository->where('token', $token)->first();

        return view('survey.answer', compact('surveys'));
    }

    public function radioAnswer(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->only('number', 'num_as');

            return [
                'success' => true,
                'data' => view('temps.text_radio', $param)->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function otherRadio(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.text_other_radio', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function checkboxAnswer(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->only('number', 'num_as', 'type');

            return [
                'success' => true,
                'data' => view('temps.text_checkbox', $param)->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function otherCheckbox(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.text_other_checkbox', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function radioQuestion(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.radio_question', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function checkboxQuestion(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.checkbox_question', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function shortQuestion(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.short_question', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function longQuestion(Request $request)
    {
        if ($request->ajax()) {
            $number = $request->get('number');

            return [
                'success' => true,
                'data' => view('temps.long_question', compact('number'))->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function textOther(Request $request)
    {
        if ($request->ajax()) {
            $idQuestion = $request->get('idQuestion');
            $idAnswer = $request->get('idAnswer');

            return [
                'success' => true,
                'data' => view('temps.text_other', compact('idAnswer', 'idQuestion'))
                    ->render(),
            ];
        }

        return [
            'success' => false,
        ];
    }

    public function create(Request $request)
    {
        $value = $request->get('survey-name');

        if (!strlen($value)) {
            $value = config('survey.title_default');
        }

        $survey = $this->surveyRepository
            ->create([
                'user_id' => Auth::user()->id,
                'title' => $value,
                'feature' => config('settings.survey.not_feature'),
                'token' => md5(uniqid(rand(), true)),
            ]);
        $txtQuestion = $request->get('txt-question');
        $questions = $txtQuestion['question'];
        $answers =  $txtQuestion['answers'];

        if ($survey) {
            $this->questionRepository->createMultiQuestion($survey, $questions, $answers);
        }

        return redirect()->action('SurveyController@listSurveyUser');
    }

    public function viewResult($token)
    {
        return $this->surveyRepository->resultSurvey($token);
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

    public function chart(array $inputs)
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

    public function viewChart($token)
    {
        $results = $this->surveyRepository->getResutlSurvey($token);
        $charts = [];
        if (!$results) {

            return view('view-charts', [
                'charts' => null,
                'status' => false,
            ]);
        }

        foreach ($results as $key => $value) {
            $charts[] = [
                'question' => $value['question'],
                'chart' => $this->chart($value['answers']),
            ];
        }

        return view('view-charts', [
            'charts' => $charts,
            'status' => true,
        ]);
    }
}
