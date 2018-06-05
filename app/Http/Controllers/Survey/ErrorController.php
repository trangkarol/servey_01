<?php

namespace App\Http\Controllers\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function error404()
    {
        return view('clients.layout.404');
    }

    public function error403()
    {
        return view('clients.layout.403');
    }
}
