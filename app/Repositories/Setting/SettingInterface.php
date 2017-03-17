<?php

namespace App\Repositories\Setting;

interface SettingInterface
{
    public function delete($ids);

    public function update($surveyId, $value);
}
