<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Temp\TempInterface;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Invite\InviteInterface;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use DB;

class SaveTempController extends Controller
{
    protected $tempRepository;
    protected $surveyRepository;
    protected $inviteRepository;

    public function __construct(
        TempInterface $tempRepository,
        InviteInterface $inviteRepository,
        SurveyInterface $surveyRepository
    ) {
        $this->tempRepository = $tempRepository;
        $this->inviteRepository = $inviteRepository;
        $this->surveyRepository = $surveyRepository;
    }

    public function index()
    {
        return $this->tempRepository->findByUserId(auth()->id())->paginate(config('settings.paginate'));
    }

    public function show(Request $request)
    {
        $redis = Redis::connection();
        $tempAnswers = json_decode(($redis->get(auth()->id() . '/' . $request->get('surveyId'))), true);

        if (!$tempAnswers || !$request->ajax()) {
            return [
                'success' => false,
                'message' => trans('messages.load_fail', ['object' => class_basename(Answer::class)]),
            ];
        }

        $count = count($tempAnswers);
        $survey = $this->surveyRepository->find($request->get('surveyId'));
        $view = view('user.component.temp-answer', compact('survey', 'tempAnswers', 'count'))->render();

        return [
            'success' => true,
            'view' => $view,
            'message' => trans('messages.load_success', ['object' => class_basename(Answer::class)]),
        ];
    }

    public function store(Request $request)
    {
        $isSuccess = false;

        if (!$request->ajax() || !$request->get('answer')) {
            return response()->json([
                'success' => $isSuccess,
                'message' => trans('messages.save_fail', ['object' => class_basename(Answer::class)]),
            ]);
        }

        $answers = $request->get('answer');
        $data = [];
        $surveyId = $request->get('surveyId');
        $invite = $this->inviteRepository
            ->where([
                'recevier_id' => auth()->id(),
                'survey_id' => $surveyId,
            ])
            ->orWhere(function ($query) use ($surveyId) {
                $query->where([
                    'survey_id' => $surveyId,
                    'mail' => (auth()->check()) ? auth()->user()->email : null
                ]);
            })
            ->first();

        if ($request->get('feature')
            || (!$request->get('feature') && auth()->check() && $invite)
            || auth()->id() == $request->get('userId')
        ) {
            $answers = array_except($answers, '_token');

            foreach ($answers as $keyAnswer => $answer) {
                if (!is_array($answer)) {
                    $answer = [$answer => $keyAnswer];
                }

                if ($answer[key($answer)]) {
                    foreach ($answer as $key => $value) {
                        if (!auth()->check() && !$request->get('name-answer') && !$request->get('email-answer')) {
                            $name = config('users.undentified_name');
                            $email = config('users.undentified_email');
                        } else {
                            $name = $request->get('name-answer') ?: (auth()->check() ? auth()->user()->name : config('users.undentified_name'));
                            $email = $request->get('email-answer') ?: (auth()->check() ? auth()->user()->email : config('users.undentified_email'));
                        }

                        $data[] = [
                            'answer_id' => $key,
                            'content' => $value,
                            'name' => $name,
                            'email' => $email,
                        ];
                    }
                }
            }

            DB::beginTransaction();
            try {
                $key = auth()->id() . '/' . $surveyId;
                $this->tempRepository->firstOrCreate([
                    'user_id' => auth()->id(),
                    'survey_id' => $surveyId,
                    'key' => $key,
                ]);

                $value = json_encode($data);
                $redis = Redis::connection();
                $redis->set($key, $value);
                $isSuccess = true;
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
            }
        }

        return response()->json([
            'success' => $isSuccess,
            'message' => trans(($isSuccess)
                ? 'messages.save_success'
                : 'messages.save_fail', [
                    'object' => class_basename(Answer::class)
            ]),
        ]);
    }
}
