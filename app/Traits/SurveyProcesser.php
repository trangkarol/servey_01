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
}
