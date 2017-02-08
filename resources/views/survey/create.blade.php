@extends('user.master')
@section('content')
    {!! Form::open([ 'action ' => 'User\SurveyController@create', 'class' => 'form-horizontal']) !!}
        <div class="content-question container">
            <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-6 col-md-offset-3">
                    {!! Form::text('survey-name', 'surver name', [
                        'placeholder' => trans('home.name_survey'),
                        'required' => true,
                    ]) !!}
                </div>
            </div>
            <div class="add-question col-md-1">
                <a class="glyphicon glyphicon-plus-sign">
                    <ul>
                        <li>
                            {!! Form::button(trans('home.choices'), [
                                'url' => action('User\SurveyController@radioQuestion'),
                                'id' => 'radio-button',
                                'typeId' => config('survey.type_radio'),
                            ]) !!}
                        </li>
                        <li>
                            {!! Form::button(trans('home.checkboxes'), [
                                'url' => action('User\SurveyController@checkboxQuestion'),
                                'id' => 'checkbox-button',
                                'typeId' => config('survey.type_checkbox'),
                            ]) !!}
                        </li>
                        <li>
                            {!! Form::button(trans('home.short_answer'), [
                                'url' => action('User\SurveyController@shortQuestion'),
                                'id' => 'short-button',
                                'typeId' => config('survey.type_short'),
                            ]) !!}
                        </li>
                        <li>
                            {!! Form::button(trans('home.passage'), [
                                'url' => action('User\SurveyController@longQuestion'),
                                'id' => 'long-button',
                                'typeId' => config('survey.type_long'),
                            ]) !!}
                        </li>
                    </ul>
                </a>
            </div>
            <div class="hide"></div>
            {!! Form::submit(trans('home.finish'), [
                'class'=>'bt-finish',
            ]) !!}
        </div>
    {!! Form::close() !!}
@endsection
@section('content-bot')
    <div class="inner">
        <h2>{{ trans('home.wellcome') }}, {{ Auth::user()->name }}</h1>
    </div>
@endsection
