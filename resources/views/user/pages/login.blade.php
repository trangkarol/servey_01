@extends('user.master')
@section('content')
    <div class="survey_container animated zoomIn wizard" novalidate="novalidate" >
        <div class="top-wizard-register">
            <strong class="tag-wizard-top">
                {{ trans('login.login') }}
            </strong>
        </div>
        {!! Form::open([
            'action' => 'Auth\LoginController@login',
            'method' => 'POST',
        ]) !!}
            <div id="wizard-login middle-wizard" class="wizard-branch wizard-wrapper">
                <div class="step wizard-step current">
                    <div class="container-login row">
                        <h3 class="label-header col-md-10 wizard-header col-md-offset-1">
                            {{ trans('login.enter_email_password') }}
                        </h3>
                        <div class="col-md-8 col-md-offset-2">
                            <ul class="data-list">
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'email1.png', '') !!}
                                        {!! Form::email('email', '', [
                                            'id' => 'email',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('login.email'),
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'lock1.png', '') !!}
                                        {!! Form::password('password', [
                                            'id' => 'password',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('login.password'),
                                        ]) !!}
                                    </div>
                                </li>
                                <li class="social-li" >
                                    <div>
                                        <ul class="data-list social-bookmarks clearfix">
                                            <li class="facebook">
                                                <a href="{{ action('User\SocialAuthController@redirect', [config('settings.facebook')]) }}">
                                                </a>
                                            </li>
                                            <li class="googleplus">
                                                <a href="{{ action('User\SocialAuthController@redirect', [config('settings.google')]) }}">
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="{{ action('User\SocialAuthController@redirect', [config('settings.twitter')]) }}">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                @if (Session::has('message'))
                                    <div class="alert alert-warning warning-login-register">
                                        <p>{{ Session::get('message') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bottom-wizard" class="bottom-wizard-register">
                {!! Form::submit(trans('login.login'), [
                    'class' => 'bt-login forward',
                ]) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('content-info-web')
    @include('user.blocks.info-web')
@endsection
