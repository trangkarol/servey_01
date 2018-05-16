<?php

namespace App\Repositories\Survey;

use DB;
use Exception;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Like\LikeInterface;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Section\SectionInterface;
use App\Repositories\BaseRepository;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use Carbon\Carbon;
use App\Models\Survey;
use Auth;
use App\Traits\SurveyProcesser;
use App\Mail\ManageSurvey;
use App\Mail\InviteSurvey;
use Mail;

class SurveyRepository extends BaseRepository implements SurveyInterface
{
    use SurveyProcesser;

    public function getModel()
    {
        return Survey::class;
    }

    public function getResutlSurvey($survey)
    {
        foreach ($survey->sections as $section) {
            $temp = [];

            foreach ($section->questions as $question) {
                if (!in_array($question->type, [
                    config('settings.question_type.image'),
                    config('settings.question_type.video'),
                ])) {
                    $totalAnswerResults = config('settings.number_0');
                    $questionType = $question->type;
                    $resultQuestion = [];

                    if (in_array($question->type, [
                        config('settings.question_type.short_answer'),
                        config('settings.question_type.long_answer'),
                        config('settings.question_type.date'),
                        config('settings.question_type.time'),
                    ])) {
                        $resultQuestion = $this->getTextQuestionResult($question);
                    } else {
                        if ($question->answers->count()) {
                            $resultQuestion = $this->getResultChoiceQuestion($question);
                        } else { // title
                            $resultQuestion['temp'] = $question->title;
                            $resultQuestion['total_answer_results'] = $totalAnswerResults;
                        }
                    }

                    $temp = $resultQuestion['temp'];
                    $totalAnswerResults = $resultQuestion['total_answer_results'];
                    $questionResult[] = [
                        'question' => $question,
                        'question_type' => $question->type,
                        'count_answer' => $totalAnswerResults,
                        'answers' => $temp,
                    ];
                    $temp = [];
                }
            }

            $resultsSurveys[] = [
                'section' => $section,
                'question_result' => $questionResult,
            ];
            $questionResult = [];
        }

        return $resultsSurveys;
    }

    public function createSurvey($userId, $data, $status)
    {
        try {
            $surveyInputs = [
                'title' => $data->get('title'),
                'description' => $data->get('description'),
                'start_time' => $data->get('start_time'),
                'end_time' => $data->get('end_time'),
            ];
            $data = $data->all();

            $surveyInputs['feature'] = config('settings.survey.feature.default');
            $surveyInputs['token'] = md5(uniqid(rand(), true));
            $surveyInputs['token_manage'] = md5(uniqid(rand(), true));
            $surveyInputs['status'] = $status;

            $survey = parent::create($surveyInputs);

            if (!$survey) {
                throw new Exception('Error Processing Request', 1);
            }

            //create owner
            $owner = $survey->members()->attach($userId, [
                'role' => Survey::OWNER,
                'status' => Survey::APPROVE,
            ]);

            // create members
            foreach ($data['members'] as $member) {
                $memberId = app(UserInterface::class)->where('email', $member['email'])->first()->id;
                $survey->members()->attach($memberId, [
                    'role' => $member['role'],
                    'status' => Survey::APPROVE,
                ]);
            }

            // create invite email
            $inviteData = $data['invited_email'];

            if ($inviteData['emails']) {
                $inviteMails = $this->formatInviteMailsString($inviteData['emails']);

                $survey->invite()->create([
                    'invite_mails' => $inviteMails,
                    'answer_mails' => '',
                    'subject' => $inviteData['subject'],
                    'message' => $inviteData['message'],
                    'status' => config('settings.survey.invite_status.not_finish'),
                    'number_invite' => count($inviteData['emails']),
                    'number_answer' => config('settings.survey.number_answer_default'),
                ]);
            }

            // create settings of survey
            $settingsData = $this->createSettingDataArray($data['setting']);
            $settingMailToWsm = [
                'key' => config('settings.setting_type.send_mail_to_wsm.key'),
                'value' => $inviteData['send_mail_to_wsm'],
            ];

            array_push($settingsData, $settingMailToWsm);
            $survey->settings()->createMany($settingsData);

            $orderSection = 0;

            // create sections
            foreach ($data['sections'] as $section) {
                $sectionData['title'] = $section['title'];
                $sectionData['description'] = $section['description'];
                $sectionData['order'] = ++ $orderSection;
                $sectionData['update'] = config('settings.survey.section_update.default');

                $sectionCreated = $survey->sections()->create($sectionData);

                $orderQuestion = 0;

                // create questions
                if (isset($section['questions'])) {
                    foreach ($section['questions'] as $question) {
                        $questionData['title'] = $question['title'];
                        $questionData['description'] = $question['description'];
                        $questionData['required'] = $question['require'];
                        $questionData['order'] = ++ $orderQuestion;
                        $questionData['update'] = config('settings.survey.question_update.default');

                        $questionCreated = $sectionCreated->questions()->create($questionData);

                        // create type question on setting
                        $valueSetting = $question['type'] == config('settings.question_type.date') ? $question['date_format'] : '';
                        $questionCreated->settings()->create([
                            'key' => $question['type'],
                            'value' => $valueSetting,
                        ]);

                        // create image or video (media) of question
                        if ($question['media']) {
                            $questionMedia['user_id'] = $userId;
                            $questionMedia['url'] = $this->cutUrlImage($question['media']);
                            $questionMedia['type'] = config('settings.media_type.image');

                            if ($question['type'] == config('settings.question_type.video')) {
                                $questionMedia['type'] = config('settings.media_type.video');
                            }

                            $questionCreated->media()->create($questionMedia);
                        }

                        // create answers
                        if (isset($question['answers'])) {
                            foreach ($question['answers'] as $answer) {
                                $answerData['content'] = $answer['content'];
                                $answerData['update'] = config('settings.survey.answer_update.default');;

                                $answerCreated = $questionCreated->answers()->create($answerData);

                                // create type answer on setting
                                $answerCreated->settings()->create([
                                    'key' => $answer['type'],
                                ]);

                                // create image (media) of answer
                                if ($answer['media']) {
                                    $answerMedia['user_id'] = $userId;
                                    $answerMedia['url'] = $this->cutUrlImage($answer['media']);
                                    $answerMedia['type'] = config('settings.media_type.image');

                                    $answerCreated->media()->create($answerMedia);
                                }
                            }
                        }
                    }
                }
            }

            // if survey is create
            if ($status == config('settings.survey.status.open')) {
                // send mail manage to owner
                $emailData = [
                    'name' => Auth::user()->name,
                    'title' => $data['invited_email']['subject'],
                    'messages' => $data['invited_email']['message'],
                    'description' => $survey->description,
                    'linkManage' => route('surveys.edit', $survey->token_manage),
                    'link' => route('survey.create.do-survey', $survey->token),
                ];

                Mail::to(Auth::user()->email)->queue(new ManageSurvey($emailData));

                // send mail manage to members
                foreach ($data['members'] as $member) {
                    $emailData['name'] = app(UserInterface::class)->where('email', $member['email'])->first()->name;
                    Mail::to($member['email'])->queue(new ManageSurvey($emailData));
                }

                // send mail invite
                Mail::to($inviteData['emails'])->queue(new InviteSurvey($emailData)); 
            }

            return $survey;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function checkCloseSurvey($inviteIds, $surveyIds)
    {
        $ids = array_merge(
            $inviteIds->lists('survey_id')->toArray(),
            $surveyIds->lists('id')->toArray()
        );

        return app(SettingInterface::class)
            ->whereIn('survey_id', $ids)
            ->where([
                'key' => config('settings.key.limitAnswer'),
                'value' => 0,
            ])
            ->lists('survey_id')
            ->toArray();
    }

    public function listsSurvey($userId, $email = null)
    {
        $invites = $inviteIds = app(InviteInterface::class)
            ->where('recevier_id', $userId)
            ->orWhere('mail', $email);
        $surveys = $surveyIds = $this->where('user_id', $userId)->orWhere('mail', $email);
        $settings = $this->checkCloseSurvey($inviteIds, $surveyIds);
        $invites = $invites
            ->orderBy('id', 'desc')
            ->paginate(config('settings.paginate'));
        $surveys = $surveys
            ->orderBy('id', 'desc')
            ->paginate(config('settings.paginate'));

        return compact('surveys', 'surveys', 'settings');
    }

    public function checkSurveyCanAnswer(array $inputs)
    {
        $date = ($inputs['deadline']) ? Carbon::parse($inputs['deadline'])->gt(Carbon::now()) : true;
        $invite = true;
        $email = $inputs['email'];
        $surveyId = $inputs['surveyId'];

        if (!$date || !$inputs['status']) {
            return false;
        } elseif (!$inputs['type']) {
            $invite = app(InviteInterface::class)
                ->where('recevier_id', $inputs['userId'])
                ->where('survey_id', $inputs['surveyId'])
                ->orWhere(function ($query) use ($email, $surveyId) {
                    $query->where('mail', $email)->where('survey_id', $surveyId);
                })
                ->exists();
        }

        return $invite;
    }

    public function getSettings($surveyId)
    {
        if (!$surveyId) {
            return [];
        }

        return app(SettingInterface::class)
            ->where('survey_id', $surveyId)
            ->lists('value', 'key')
            ->toArray();
    }

    public function getHistory($userId, $clientIp, $surveyId, array $options)
    {
        if (!$surveyId) {
            return [
                'history' => [],
                'results' => [],
            ];
        }


        if ($userId) {
            if ($options['type'] == 'history') {
                $results = app(QuestionInterface::class)
                    ->getResultByQuestionIds($surveyId)
                    ->where('sender_id', $userId)
                    ->get();
            } else {
                $email = $options['email'];
                $name = $options['name'];
                $results = app(QuestionInterface::class)
                    ->getResultByQuestionIds($surveyId)
                    ->where(
                        function ($query) use ($userId, $clientIp, $email) {
                            $query->where('sender_id', $userId)
                                ->orWhere(
                                    function ($query) use ($clientIp, $email) {
                                        $query->where('email', $email)
                                            ->where('client_ip', $clientIp);
                                    }
                                );
                        }
                    )
                    ->get()
                    ->toArray();

                if (empty($email) && $name) {
                    $results = app(QuestionInterface::class)
                        ->getResultByQuestionIds($surveyId)
                        ->where(
                            function ($query) use ($userId, $clientIp, $name) {
                                $query->where('sender_id', $userId)
                                    ->orWhere(
                                        function ($query) use ($clientIp, $name) {
                                            $query->where('name', $name)
                                                ->where('client_ip', $clientIp);
                                        }
                                    );
                            }
                        )
                        ->get()
                        ->toArray();
                }

                $collection = collect($results);

                return $collection->groupBy('created_at')->toArray();
            }
        } else {
            if ($options['type'] == 'history') {
                $results = app(QuestionInterface::class)
                    ->getResultByQuestionIds($surveyId)
                    ->where('sender_id', null)
                    ->where('client_ip', $clientIp)
                    ->get();
            }
        }

        if (!$results) {
            return [];
        }

        $history = [];
        $maxCreate = $results->max('created_at');

        foreach ($results as $key => $value) {
            if ($options['type'] == 'history' && $value->created_at == $maxCreate) {
                $history[$value->answer_id] = $value->content;
            }
        }

        return [
            'history' => $history,
            'results' => $results,
        ];
    }

    public function getUserAnswer($token)
    {
        $survey = $this->where('token', $token)->orWhere('token_manage', $token)->first();

        if (!$survey) {
            return false;
        }

        $results = app(QuestionInterface::class)
            ->getResultByQuestionIds($survey->id)
            ->with('sender');
        $results = $results->distinct('created_at')->get([
            'created_at',
            'name',
            'email',
            'sender_id',
            'client_ip',
        ])
        ->toArray();

        if (!$results) {
            return [];
        }
        /*
            Get all user answer survey and group by user id.
            Sender_id can be null.
        */
        $collection = collect($results)->groupBy('sender_id')->toArray();
        //  Get users login when anwser survey with key = user id.
        $userLogin = collect($collection)->except([''])->toArray();
        /*
            Get users not login when answer survey and group by email.
            Email can be set default because user don't need enter email.
        */
        $settings = $this->getSettings($survey->id);

        $userNotLogin = in_array('', array_keys($collection))
                ? collect(collect($collection['']))->groupBy('client_ip')->toArray()
                : [];

        return array_merge($userLogin, $userNotLogin);
    }

    private function chart(array $inputs)
    {
        $results = [];

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
        $results = $this->getResutlSurvey($token);
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

    /* new */
    public function getResultExport($survey)
    {
        $requiredSurvey = $survey->required;
        $questions = app(QuestionInterface::class)->whereIn('section_id', $survey->sections->pluck('id'))
            ->with('answerResults', 'settings')->get();
        $results = app(ResultInterface::class)->whereIn('question_id', $questions->pluck('id'))
            ->with('answer.settings', 'user')->get()->groupBy(
                function($date) {
                    return Carbon::parse($date->created_at)->format('Y-m-d H:m:s.u');
                }
            );

        return [
            'questions' => $questions,
            'results' => $results,
            'requiredSurvey' => $requiredSurvey,
        ];
    }

    public function duplicateSurvey($survey)
    {
        $survey->load('questions', 'settings');
        $newSurvey = $survey->replicate();

        $token = md5(uniqid(rand(), true));
        $tokenManage = md5(uniqid(rand(), true));

        $newSurvey->token = $token;
        $newSurvey->token_manage = $tokenManage;

        $newSurvey->deadline = null;
        $newSurvey->status = config('survey.status.block');

        $newSurvey->push();

        foreach ($survey->getRelations() as $relation => $items) {
            foreach ($items as $item) {
                $newItemRelation = $newSurvey->{$relation}()->create($item->toArray());

                if ($newItemRelation instanceof Question) {
                    $item->duplicate($newItemRelation);
                }
            }
        }

        return $newSurvey;
    }

    public function checkExist($token)
    {
        return $this->model->where('token', $token)->exists();
    }

    public function getSurveyByTokenManage($token)
    {
        return $this->model->with([
            'settings',
            'invite',
            'members' => function ($query) {
                $query->where('role', Survey::APPROVE);
            },
            'sections' => function ($query) {
                $query->with([
                    'questions' => function ($query) {
                        $query->with('answers.media', 'settings', 'media');
                    },
                ]);
            },
        ])->where('token_manage', $token)->first();
    }

    public function getSurveysByStatus($status)
    {
        return $this->model->where('status', $status);
    }

    public function getAuthSurveys($flag, $data = [])
    {
        $userId = Auth::user()->id;

        $survey = $this->model;

        //check flag
        if ($flag == config('settings.survey.members.owner') ||
            $flag == config('settings.survey.members.editor')) {
            $survey = $survey->whereHas('members', function ($query) use ($flag, $userId) {
                $query->where('role', $flag)
                    ->where('user_id', $userId);
            });
        }
        
        //check paramater
        if (isset($data['name']) && !empty($data['name'])) {
            $survey = $survey->where('title', 'like', '%' . $data['name'] . '%');
        }

        if (isset($data['privacy']) && !empty($data['privacy'])) {
            $privacy = $data['privacy'];
            $survey = $survey->whereHas('settings', function ($query) use ($privacy) {
                $query->where('key', config('settings.setting_type.privacy.key'))
                    ->where('value', $privacy);
            });
        }

        if (isset($data['status']) && !empty($data['status'])) {
            $survey = $survey->where('status', $data['status']);
        }


        return $survey->paginate(config('settings.survey.paginate'));
    }

    //get survey by token
    public function getSurvey($token)
    {
        return $this->model->where('token', $token)->with(['sections.questions' => function ($query) {
            $query->with(['settings', 'media',
                'answers' => function ($queryAnswer) {
                    $queryAnswer->with('settings', 'media');
                }]);
            }])->first();
    }

    //get section current
    public function getSectionCurrent($survey, $currentSection)
    {
        return $survey->sections->where('order', $currentSection)->first();
    }

    public function deleteSurvey($survey)
    {
        $survey->invite()->delete();
        $survey->settings()->delete();
        $survey->members()->detach();

        return $survey->forceDelete();
    }

    public function countSurveyDraftOfUser($userId)
    {
        return $this->model->where('status', config('settings.survey.status.draft'))
            ->whereHas('members', function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('role', Survey::OWNER);
            })->count();
    }
}
