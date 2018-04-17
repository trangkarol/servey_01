<?php

namespace App\Traits;

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

            array_push($resultData, $temp);
        }

        return $resultData;
    }
}
