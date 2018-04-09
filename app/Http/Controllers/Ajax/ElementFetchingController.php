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
}
