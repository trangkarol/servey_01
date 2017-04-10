@extends('user.master')
@section('content')
    <div class="feedback survey_container animated zoomIn wizard" novalidate="novalidate">
        {!! Form::open([
            'action' => 'FeedbackController@create',
        ]) !!}
        <div class="panel panel-default panel-darkcyan-profile">
            <div class="panel-heading panel-heading-darkcyan">{{ trans('home.feedback') }}</div>
            <div class="panel-body">
                <div class="container-infor">
                    {!! Html::image(config('settings.image_system') . 'name.png', '') !!}
                    {!! Form::text('name', '', [
                        'placeholder' => trans('login.your_name'),
                        'id' => 'name',
                        'class' => 'required form-control',
                    ]) !!}
                </div>
                <div class="container-infor">
                    {!! Html::image(config('settings.image_system') . 'email1.png', '') !!}
                    {!! Form::email('email', '', [
                        'id' => 'email',
                        'class' => 'required form-control',
                        'placeholder' => trans('login.your_email'),
                    ]) !!}
                </div>
                {!! Form::textarea('content','', [
                    'class' => 'js-elasticArea form-control textarea-feedback',
                    'placeholder' => trans('info.feedback'),
                ]) !!}
                {!! Form::submit(trans('survey.send'), [
                    'class' => 'submit-feedback form-control',
                ]) !!}
                @if (count($errors))
                    <div class="alert alert-danger alert-message">
                        @foreach ($errors->all() as $error)
                            <p> {!! $error !!} </p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
