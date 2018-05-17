<?php

namespace App\Traits;

use Session;

trait SurveyProcesser
{
    public function formatInviteMailsString($data)
    {
        $invite_mails = '';

        foreach ($data as $mail) {
            $invite_mails .= $mail . '/';
        }

        return $invite_mails;
    }

    public function getKeySetting($content)
    {
        $content = trim($content);

        switch ($content) {
            case config('settings.setting_type.answer_required.content'):
                return config('settings.setting_type.answer_required.key');
            case config('settings.setting_type.answer_limited.content'):
                return config('settings.setting_type.answer_limited.key');
            case config('settings.setting_type.reminder_email.content'):
                return config('settings.setting_type.reminder_email.key');
            case config('settings.setting_type.privacy.content'):
                return config('settings.setting_type.privacy.key');
            case config('settings.setting_type.question_type.content'):
                return config('settings.setting_type.question_type.key');
            case config('settings.setting_type.answer_type.content'):
                return config('settings.setting_type.answer_type.key');
            default:
                throw new Exception("Error Processing Request", 1);
        }
    }

    public function createSettingDataArray($data)
    {
        $resultData = [];

        foreach ($data as $keyContent => $value) {
            $temp = [
                'key' => $this->getKeySetting($keyContent),
                'value' => $value,
            ];

            if ($keyContent == config('settings.setting_type.reminder_email.content')) {
                $temp['value'] = $value['type'];

                if (!empty($value['next_time'])) {
                    $nextRemindTime = [
                        'key' => config('settings.setting_type.next_remind_time.key'),
                        'value' => $value['next_time'],
                    ];

                    array_push($resultData, $nextRemindTime);
                }
            }

            array_push($resultData, $temp);
        }

        return $resultData;
    }

    public function cutUrlImage($url)
    {
        $url = trim($url);
        $webUrl = url('/');

        if (strpos($url, $webUrl) === 0) {
            $url = substr($url, strlen($webUrl));
        }

        return $url;
    }

    public function reloadPage($key, $numOfSection, $section_order)
    {
        if (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === config('settings.detect_page_refresh')) {
            Session::put($key, $section_order);
        } elseif (!Session::has($key) ||
            Session::get($key) > $numOfSection ||
            Session::get($key) < $section_order) {
                Session::put($key, $section_order);
        }
    }

    public function getUserFromInvite($invite)
    {
        return [
            'inviteMails' => array_pop(explode('/', $invite->invite_mails)),
            'answerMails' => array_pop(explode('/', $invite->answer_mails)),
        ];
    }

    // get result text question
    public function getTextQuestionResult($question)
    {
        $temp = [];
        $answerResults = $question->answerResults->where('content', '<>', config('settings.group_content_result'));
        $totalAnswerResults = $answerResults->count();

        if ($totalAnswerResults) {
            $answerResults = $answerResults->groupBy('upper_content');

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

        return [
            'temp' => $temp,
            'total_answer_results' => $totalAnswerResults,
        ];
    }

    // get result choice quesion
    public function getResultChoiceQuestion($question)
    {
        $temp = [];
        $totalAnswerResults = $question->results->count();

        foreach ($question->answers as $answer) {
            if ($totalAnswerResults) {
                // get choice answer other
                if ($answer->type == config('settings.answer_type.other_option')) {
                    $answerOthers = $answer->results->groupBy('content');

                    foreach ($answerOthers as $answerOther) {
                        $count = $answerOther->count();

                        $temp[] = [
                            'answer_id' => $answerOther->first()->answer_id,
                            'answer_type' => config('settings.answer_type.other_option'),
                            'content' => $answerOther->first()->content ? $answerOther->first()->content : trans('result.other'),
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

        return [
            'temp' => $temp,
            'total_answer_results' => $totalAnswerResults,
        ];
    }
}
