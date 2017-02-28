<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
            ]);
        }

        Session::put('locale', $request->get('language'));

        return response()->json([
            'success' => true,
            'urlBack' => url()->previous(),
        ]);
    }
}
