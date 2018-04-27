<?php

namespace App\Repositories\Survey;

use DB;
use Exception;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Like\LikeInterface;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\BaseRepository;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use Carbon\Carbon;
use App\Models\Survey;
use Auth;
use App\Traits\SurveyProcesser;

class SurveyRepository extends BaseRepository implements SurveyInterface
{
    use SurveyProcesser;

    public function __construct(Survey $survey)
    {
        parent::__construct($survey);
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            $ids = is_array($ids) ? $ids : [$ids];
            app(InviteInterface::class)->deleteBySurveyId($ids);
            app(LikeInterface::class)->deleteBySurveyId($ids);
            app(QuestionInterface::class)->deleteBySurveyId($ids);
            app(SettingInterface::class)->deleteBySurveyId($ids);
            parent::delete($ids);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function getResutlSurvey($token)
    {
        $survey = $this->where('token', $token)->with('sections.questions.answers.results')->first();

        foreach ($survey->sections as $section) {
            $temp = [];

            foreach ($section->questions as $question) {
                $totalAnswerResults = config('settings.number_0');

                if ($question->answerResults->count()) {
                    $totalAnswerResults = $question->answerResults->count();

                    if ($totalAnswerResults) {
                        $answerResults = $question->answerResults->groupBy('content');

                        foreach ($answerResults as $answerResult) {
                            $count = $answerResult->count();

                            $temp[] = [
                                'content' => $answerResult->first()->content,
                                'percent' => round(($totalAnswerResults) ?
                                    (double)($count * config('settings.number_100')) / ($totalAnswerResults) :
                                    config('settings.number_0'), config('settings.roundPercent')),
                            ];
                        }
                    }
                } else {
                    if ($question->answers->count()) {
                        $totalAnswerResults = $question->results->count();

                        foreach ($question->answers as $answer) {
                            if ($totalAnswerResults) {
                                if ($answer->settings()->first()->key == config('settings.answer_type.other_option')) {
                                    $answerOthers = $answer->results->groupBy('content');

                                    foreach ($answerOthers as $answerOther) {
                                        $count = $answerOther->count();

                                        $temp[] = [
                                            'answer_id' => $answerOther->first()->answer_id,
                                            'answer_type' => config('settings.answer_type.other_option'),
                                            'content' => $answerOther->first()->content,
                                            'percent' => round(($totalAnswerResults) ?
                                                (double)($count * config('settings.number_100')) / ($totalAnswerResults) :
                                                config('settings.number_0'), config('settings.roundPercent')),
                                        ];
                                    }
                                } else {
                                    $answerResults = $answer->results->count();

                                    $temp[] = [
                                        'answer_id' => $answer->id,
                                        'answer_type' => config('settings.answer_type.option'),
                                        'content' => $answer->content,
                                        'percent' => round(($totalAnswerResults) ?
                                            (double)($answerResults * config('settings.number_100')) / ($totalAnswerResults) :
                                            config('settings.number_0'), config('settings.roundPercent')),
                                    ];
                                }
                            }
                        }
                    } elseif ($question->settings()->first()->key == config('settings.question_type.title')) {
                        $temp[] = [
                            'content' => $question->title,
                        ];
                    }
                }

                $questionResult[] = [
                    'question' => $question,
                    'question_type' => $question->settings()->first()->key,
                    'count_answer' => $totalAnswerResults,
                    'answers' => $temp,
                ];
                $temp = [];
            }

            $resultsSurveys[] = [
                'section' => $section,
                'question_result' => $questionResult,
            ];
            $questionResult = [];
        }

        return $resultsSurveys;
    }

    public function createSurvey($userId, $data)
    {
        DB::beginTransaction();

        try {
            if ($userId != Auth::user()->id) {
                throw new Exception("Error Processing Request", 1);
            }

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
            $surveyInputs['status'] = config('settings.survey.status.public');

            $survey = parent::create($surveyInputs);

            if (!$survey) {
                throw new Exception("Error Processing Request", 1);
            }

            //create owner
            $survey->members()->attach($userId, [
                'role' => Survey::OWNER,
                'status' => Survey::APPROVE,
            ]);

            // create member
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
                $invite_mails = $this->formatInviteMailsString($inviteData['emails']);

                $survey->invites()->create([
                    'invite_mails' => $invite_mails,
                    'answer_mails' => '',
                    'status' => config('settings.survey.invite_status.not_finish'),
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
                        $questionSetting['key'] = config('settings.setting_type.question_type.key');
                        $questionSetting['value'] = $question['type'];
                        $questionCreated->settings()->create($questionSetting);

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
                                $answerSetting['key'] = config('settings.setting_type.answer_type.key');
                                $answerSetting['value'] = $answer['type'];
                                $answerCreated->settings()->create($answerSetting);

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

            DB::commit();

            return $survey;
        } catch (Exception $e) {
            DB::rollback();

            return false; 
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

    public function exportExcel($id)
    {
        $survey = $this->model->find($id);

        $checkRequireAnswer = $survey->settings()->where('key', config('settings.key.requireAnswer'))->pluck('value', 'key')->all();
        $results = [];
        $questions = $survey->questions()->with('results.answer')->get()->all();
        $numberResults = count($survey->questions->first()->results()->get()->all());
        $numberQuestion = count($questions);

        for ($i = 0; $i < $numberResults; $i ++) {
            $question = [];
            for ($j = 0; $j < $numberQuestion; $j ++) {
                if (isset($questions[$j]['results'][$i])) {
                    $question = $questions[$j]['results'][$i];
                }
            }

            $results[] = $question;
        }

        return [
            'questions' => $questions,
            'results' => $results,
            'checkRequireAnswer' => $checkRequireAnswer,
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
        return $this->model->where('token_manage', $token)->first();
    }

    public function getSurveysByStatus($status)
    {
        return $this->model->where('status', $status);
    }

    public function getAuthSurveys()
    {
        $surveyIds = Auth::user()->members()
            ->where('role', config('settings.survey.members.owner'))
            ->pluck('survey_id');

        return $this->model->whereIn('id', $surveyIds)->get();
    }
}
