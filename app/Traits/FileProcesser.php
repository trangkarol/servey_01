<?php

namespace App\Traits;

use File;

trait FileProcesser
{
    public function UploadImage($request, $name)
    {
        $file = $request->file($name);
        $newFileName = time() . '.'. $file->getClientOriginalExtension();
        $file->move(config('settings.path_upload'), $newFileName);

        return $newFileName;
    }
}
