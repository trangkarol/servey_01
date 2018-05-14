<?php

namespace App\Traits;

use ErrorException;
use Auth;

trait ClientInformation
{
    public function getClientIP()
    {
        try {
            $wanIp = file_get_contents('http://bot.whatismyipaddress.com');
        } catch (ErrorException $e) {
            $wanIp = 'UNKNOWN';
        }

        $ipaddress = $wanIp . '+';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress .= $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress .= $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress .= $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipaddress .= $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress .= $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress .= $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress .= $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress .= 'UNKNOWN';
        }

        return $ipaddress;
    }

    public function processAnswererInformation($data, $survey)
    {
        // get client information
        $clientInfo['client_ip'] = $data->get('client_ip');

        $answerRequiredSetting = $survey->settings()->where('key', config('settings.setting_type.answer_required.key'))->first()->value;

        // check answer_required setting
        switch ($answerRequiredSetting) {
            case config('settings.survey_setting.answer_required.none'):
                # code...
                break;
            case config('settings.survey_setting.answer_required.login'):
                $userId = $data->get('user_id');

                if ($userId != Auth::user()->id) {
                    throw new Exception("Error Processing Request", 1);
                }

                $clientInfo['user_id'] = $userId;

                // update mail invite and mail answer
                $userMail = Auth::user()->email . '/';
                $invite = $survey->invite;

                $invite->update([
                    'invite_mails' => str_replace($userMail, '', $invite->invite_mails),
                    'answer_mails' => $invite->answer_mails . $userMail,
                ]);

                break;
            case config('settings.survey_setting.answer_required.login_with_wsm'):
                # code...
                break;
            default:
                throw new Exception("Error Processing Request", 1);
                return;
        }

        return $clientInfo;
    }
}
