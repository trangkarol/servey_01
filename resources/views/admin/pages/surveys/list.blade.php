@extends('admin.master')
@section('content')
<div class="row" id="survey-list">
    <div class="hide" data-route="{!! url('/') !!}"></div>
    <div class="col-md-12">
    {!! Form::open(['action' => ['Admin\SurveyController@update', config('settings.not_feature')], 'method' => 'PUT']) !!}
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.survey') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="alert-message">
                @if (Session::get('message-success'))
                    <div class="alert alert-success">
                        <span>
                            <p>
                                {{ Session::get('message-success') }}
                            </p>
                        </span>
                    </div>
                @elseif (Session::get('message-fail'))
                    <div class="alert alert-warning">
                        <span>
                            <p>
                                {{ Session::get('message-fail') }}
                            </p>
                        </span>
                    </div>
                @endif
            </div>
            @include('admin.blocks.list', ['surveys' => $surveyFeatures])
        </div>
        {!! Form::button(trans('admin.change_feature'), [
            'class' => 'btn btn-primary',
            'id' => 'changeFeature',
            'type' => 'submit'
        ]) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.survey') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            {!! Form::open(['action' => ['Admin\SurveyController@update', config('settings.feature')], 'method' => 'PUT']) !!}
            @include('admin.blocks.list', ['surveys' => $surveys])
        </div>
        {!! Form::button(trans('admin.update_feature'), [
            'class' => 'btn btn-primary',
            'id' => 'updateFeature',
            'type' => 'submit',
        ]) !!}
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-md-12 offset-6">
            {{ $surveyAll->render() }}
        </div>
    </div>
</div>
@endsection
