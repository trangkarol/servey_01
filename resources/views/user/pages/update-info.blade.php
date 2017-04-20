@extends('user.master')
@section('content')
    <div id="" class="survey_container animated zoomIn wizard" novalidate="novalidate">
        <div id="top-wizard">
            <strong class="tag-wizard-top">
                {{ trans('user.update_info') }}
            </strong>
        </div>
        {!! Form::open([
            'action' => 'User\UserController@update',
            'method' => 'PUT',
            'enctype' => 'multipart/form-data',
        ]) !!}
            <div id="middle-wizard" class="wizard-register wizard-branch wizard-wrapper">
                <div class="step wizard-step current">
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
                    <div class="row">
                        <h3 class="label-header col-md-10 wizard-header">
                            {{ trans('user.enter_info') }}
                        </h3>
                        <div class="col-md-6">
                            <ul class="data-list">
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'email.png', '') !!}
                                        {!! Form::email('email', $user->email, [
                                            'placeholder' => trans('user.your_email'),
                                            'id' => 'email',
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'name.png', '') !!}
                                        {!! Form::text('name', $user->name, [
                                            'placeholder' => trans('user.your_name'),
                                            'id' => 'name',
                                            'class' => 'required form-control',
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'birthday3.png', '') !!}
                                        {!! Form::text('birthday', $user->birthday, [
                                            'placeholder' => trans('user.birthday'),
                                            'class' => 'frm-datepicker required form-control',
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'phone.png', '') !!}
                                        {!! Form::text('phone', $user->phone, [
                                            'placeholder' => trans('user.phone'),
                                            'class' => 'required form-control',
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'address.png', '') !!}
                                        {!! Form::text('address', $user->address, [
                                            'placeholder' => trans('user.address'),
                                            'class' => 'required form-control',
                                        ]) !!}
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="data-list">
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'lock3.png', '') !!}
                                        {!! Form::password('password', [
                                            'id' => 'password',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('user.old_password'),
                                        ]) !!}
                                    </div>
                                </li>
                                <li>
                                    <div class="container-infor">
                                        {!! Html::image(config('settings.image_system') . 'lock2.png', '') !!}
                                        {!! Form::password('password', [
                                            'id' => 'password',
                                            'class' => 'required form-control',
                                            'placeholder' => trans('user.retype_new_password'),
                                        ]) !!}
                                    </div>
                                </li>
                                <div class="container-infor">
                                    {!! Html::image(config('settings.image_system') . 'lock3.png', '') !!}
                                    {!! Form::password('password_confirmation', [
                                        'id' => 'password-confirm',
                                        'class' => 'required form-control',
                                        'placeholder' => trans('user.retype_new_password'),
                                    ]) !!}
                                </div>
                                <li>
                                    <div class="row">
                                        <div class="avatar-img col-md-2">
                                            {{ trans('user.avatar') }}
                                        </div>
                                         <div class="col-md-2">
                                           {!! Html::image($user->image, '', [
                                                'class' => 'img-avatar',
                                           ]) !!}
                                        </div>
                                        <div class="col-md-7">
                                            {!! Form::button('<span class="glyphicon glyphicon-picture span-menu"></span>' . trans('user.chooser_new_image'), [
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
                                            {{ Form::radio(trans('user.gender'), config('users.gender.male'), '', [
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
                                            {{ Form::radio(trans('user.gender'), config('users.gender.female'), '', [
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
            <div id="bottom-wizard">
                {!! Form::submit(trans('user.update'), [
                    'class' => 'bt-register forward',
                ]) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('content-info-web')
    @include('user.blocks.info-web')
@endsection
