<?php

namespace App\Repositories\Setting;

interface SettingInterface
{
    public function deleteSettings($settingableIds, $settingableType);
}
