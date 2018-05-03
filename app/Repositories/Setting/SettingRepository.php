<?php

namespace App\Repositories\Setting;

use Exception;
use App\Models\Setting;
use App\Repositories\BaseRepository;
use App\Repositories\Setting\SettingInterface;

class SettingRepository extends BaseRepository implements SettingInterface
{
    public function getModel()
    {
        return Setting::class;
    }

    public function delete($ids)
    {
        DB::beginTransaction();
        try {
            $ids = is_array($ids) ? $ids : [$ids];
            parent::delete($ids);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function deleteBySurveyId($surveyId)
    {
        $settings = $this->whereIn('survey_id', $surveyId)->lists('id')->toArray();
        parent::delete($settings);
    }

    public function deleteByKey($surveyId, $key)
    {
        $settings = $this->whereIn('survey_id', $surveyId)->where('key', $key)->get()->first();
        parent::delete($settings);
    }

    public function createMultiSetting(array $settings, $surveyId)
    {
        if (empty($settings)) {
            return true;
        }

        $inputs = [];

        foreach ($settings as $key => $value) {
            $inputs[] = [
                'survey_id' => $surveyId,
                'key' => $key,
                'value' => $value,
            ];
        }

        return $this->multiCreate($inputs);
    }
}
