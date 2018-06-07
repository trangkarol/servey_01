<?php

namespace App\Traits;

use Carbon\Carbon;
use Storage;

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

    public function copyFile($urlFile)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $newName = uniqid(rand(), true);
        $oldUrl = str_replace('storage', 'public', $urlFile);
        $filePath = config('settings.path_upload_image') . '/' . $year . '/' . $month . '/';
        $endFiles = explode('.', $urlFile);
        $newUrl = $filePath . $newName . '.' . end($endFiles);
        Storage::copy($oldUrl, $newUrl);
        $newUrl = str_replace('public', 'storage', $newUrl);

        return $newUrl;
    }
}
