@extends('clients.survey.elements.master')
@section('element-type', config('settings.question_type.time'))
@section('element-content')
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-5 time-answer-input">
        <span>@lang('lang.time_answer')</span> <span class="time-answer-icon"></span>
    </div>
@endsection
