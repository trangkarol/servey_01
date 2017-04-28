<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Setting\SettingInterface;
use Exception;
use LRedis;
use DB;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    protected $settingRepository;
    protected $surveyRepository;

    public function __construct(
        SurveyInterface $surveyRepository,
        SettingInterface $settingRepository
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->settingRepository = $settingRepository;
    }

    public function update(SettingRequest $request, $surveyId, $token)
    {
        $value = $request->only([
            'setting',
            'feature',
        ]);

        DB::beginTransaction();
        try {
            $this->settingRepository->update($surveyId, $value);
            $this->surveyRepository->update($surveyId, [
                'feature' => $value['feature'] ?: 0,
            ]);
            DB::commit();
            $redis = LRedis::connection();
            $redis->publish('update', json_encode([
                'success' => true,
                'surveyId' => $surveyId,
            ]));

            return redirect()->action('AnswerController@show',$token)
                ->with('message', trans('survey.update_success'));
        } catch (Exception $e) {
            throw $e;

            DB::rollback();
        }

        return redirect()->action('AnswerController@show',$token)
            ->with('message-fail', trans('survey.update_fail'));
    }
}
