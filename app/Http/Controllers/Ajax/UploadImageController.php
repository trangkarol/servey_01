<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Storage;
use App\Traits\FileProcesser;
use App\Traits\SurveyProcesser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;

class UploadImageController extends Controller
{
    use FileProcesser, SurveyProcesser;

    public function insertImage(UploadImageRequest $request)
    {
        if ($request->ajax()) {
            $filePath = $this->uploadImage($request, 'image', config('settings.path_upload_image'));
            $urlImage = url('/') . Storage::url($filePath);

            return response()->json($urlImage);
        }

        return response()->json(false);
    }

    public function removeImage(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        $urlImage = str_replace('storage', 'public', $this->cutUrlImage($request->imageURL));
        
        if (Storage::disk('local')->exists($urlImage)) {
            Storage::disk('local')->delete($urlImage);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
