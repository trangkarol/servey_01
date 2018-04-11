<?php

namespace App\Traits;

use Carbon\Carbon;

trait FileProcesser
{
    public function uploadImage($request, $name, $pathUpload)
    {
        $file = $request->file($name);
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $filePath = $file->store($pathUpload . '/' . $year . '/' . $month);

        return $filePath;
    }
}
