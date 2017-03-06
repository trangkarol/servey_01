@extends('user.master')
@section('content')
    <div id="survey_container" class="survey_container animated zoomIn wizard" novalidate="novalidate">
        <div id="top-wizard">
            <strong>{{ trans('home.progress') }}<span id="location"></span></strong>
            <div class="ui-progressbar ui-widget ui-widget-content ui-corner-all"
                id="progressbar"
                role="progressbar"
                aria-valuemin="0"
                aria-valuemax="100"
                aria-valuenow="0">
                <div class="ui-progressbar-value ui-widget-header ui-corner-left">
                </div>
            </div>
            <div class="shadow"></div>
        </div>
        {!! Form::open([
            'id' => 'wrapped',
            'class' => 'wizard-form',
            'action' => 'SurveyController@create',
            'novalidate' => 'novalidate',
            'enctype' => 'multipart/form-data',
        ]) !!}
            <div id="middle-wizard" class="wizard-branch wizard-wrapper">
                @if (Session::has('message'))
                    <div class="alert alert-info alert-message">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('message-fail'))
                    <div class="alert alert-danger alert-message">
                        {{ Session::get('message-fail') }}
                    </div>
                @endif
                @include('user.steps.step-infor')
                @include('user.steps.step-create-survey')
                @include('user.steps.step-setting')
                @include('user.steps.step-send-mail')
                @include('user.steps.step-finish')
            </div>
            <div id="bottom-wizard">
                {!! Form::button(trans('home.backward'), [
                    'class' => 'backward',
                    'disabled' => 'disabled',
                ]) !!}
                {!! Form::button(trans('home.forward'), [
                    'class' => 'forward ',
                    'disabled' => 'disabled',
                ]) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('content-info-web')
    @include('user.blocks.info-web')
@endsection
