<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ElementFetchingController extends Controller
{
    public function fetchSection(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => view('clients.survey.elements.section')->render(),
        ]);
    }

    public function fetchTitleDescription(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => view('clients.survey.elements.title-description')->render(),
        ]);
    }

    public function fetchMultipleChoice(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        return response()->json([
            'success' => true,
            'html' => view('clients.survey.elements.multiple-choice')->render(),
        ]);
    }

    public function fetchImage(Request $request)
    {
        if ($request->ajax()) {
            $imageURL = $request->imageURL;

            return response()->json([
                'success' => true,
                'html' => view('clients.survey.elements.section-image', compact('imageURL'))->render(),
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
