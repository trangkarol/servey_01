<?php

namespace App\Http\Controllers\Api1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Repositories\Survey\SurveyInterface;
use App\Http\Controllers\Api1\ApiController;
use Auth;

class SurveyController extends ApiController
{
    protected $userRepository;
    protected $surveyRepository;

    public function __construct(
        UserInterface $userRepository,
        SurveyInterface $surveyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->getData(function () {
            $this->compacts['serveys'] = $this->userRepository->getListSurveys(Auth()->user());
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.pages.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getResutSurvey($id)
    {
        return $this->getData(function () use ($id) {
            $this->compacts['serveys'] = $this->surveyRepository->exportExcel($id);
        });
    }
}
