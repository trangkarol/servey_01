<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Survey\SurveyInterface;

class DashboardController extends Controller
{
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function index()
    {
        $surveys = $this->surveyRepository->where('user_id', auth()->id())->get();

        return view('admin.pages.home', compact('surveys'));
    }
}
