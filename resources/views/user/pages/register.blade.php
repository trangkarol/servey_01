@extends('user.master')
@section('content')
    <div class="survey_container animated zoomIn wizard" novalidate="novalidate">
        <div class="top-wizard-register">
            <strong class="tag-wizard-top">
                {{ trans('login.register') }}
            </strong>
            <div class="shadow"></div>
        </div>
        {!! Form::open([
            'action' => 'Auth\RegisterController@register',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
            'id' => 'registerUser',
            'transEmailError' => trans('validation.msg.email'),
            'transFileError' => trans('validation.msg.file'),
        ]) !!}
            <div id="middle-wizard" class="wizard-register wizard-branch wizard-wrapper">
                <div class="step wizard-step current">
                    <div class="row">
                        <h3 class="label-header col-md-10 wizard-header">
                            {{ trans('login.enter_info') }}
                        </h3>
                        <div class="col-md-6">
                            <ul class="data-list">
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'email1.png', '') !!}
                                        {!! Form::email('email', '', [
                                            'id' => 'email',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('login.your_email'),
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
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'lock1.png', '') !!}
                                        {!! Form::password('password_confirmation', [
                                            'id' => 'password-confirm',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('login.repassword'),
                                        ]) !!}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="data-list">
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'name.png', '') !!}
                                        {!! Form::text('name', '', [
                                            'placeholder' => trans('login.your_name'),
                                            'id' => 'name',
                                            'class' => 'required form-control',
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="avatar-img col-md-2">
                                            {{ trans('login.avatar') }}
                                        </div>
                                        <div class="col-md-10">
                                            {!! Form::button('<span class="glyphicon glyphicon-picture span-menu"></span>' . 'choose image', [
                                                'id' => 'image',
                                                'class' => 'choose-image',
                                            ]) !!}
                                            {!! Form::file('image', [
                                                'id' => 'image',
                                                'class' => 'button-file-hidden',
                                            ]) !!}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="gender-option data-list floated clearfix">
                                <li>
                                    <div class="type-radio-answer row">
                                        <div class="box-radio col-md-1">
                                            {{ Form::radio('gender', config('users.gender.male'), '', [
                                                'id' => 'gender-male',
                                                'class' => 'input-radio',
                                            ]) }}
                                            {{ Form::label('gender-male', ' ', [
                                                'class' => 'label-radio',
                                            ]) }}
                                            <div class="check"><div class="inside"></div></div>
                                        </div>
                                        <div class="col-md-8">{{ trans('info.male') }}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="type-radio-answer row">
                                        <div class="box-radio col-md-1">
                                            {{ Form::radio('gender', config('users.gender.female'), '', [
                                                'id' => 'gender-female',
                                                'class' => 'input-radio',
                                            ]) }}
                                            {{ Form::label('gender-female', ' ', [
                                                'class' => 'label-radio',
                                            ]) }}
                                            <div class="check"><div class="inside"></div></div>
                                        </div>
                                        <div class="col-md-8">{{ trans('info.female') }}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="type-radio-answer row">
                                        <div class="box-radio col-md-1">
                                            {{ Form::radio('gender', config('users.gender.other_gender'), '', [
                                                'id' => 'gender-other',
                                                'class' => 'input-radio',
                                            ]) }}
                                            {{ Form::label('gender-other', ' ', [
                                                'class' => 'label-radio',
                                            ]) }}
                                            <div class="check"><div class="inside"></div></div>
                                        </div>
                                        <div class="col-md-8">{{ trans('info.other_gender') }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                         <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                @include('user.blocks.validate')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bottom-wizard" class="bottom-wizard-register">
                <div class="shadow-bottom"></div>
                {!! Form::submit(trans('login.register'), [
                    'class' => 'bt-register forward',
                ]) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('content-info-web')
    @include('user.blocks.info-web')
@endsection
