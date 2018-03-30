@extends('templates.survey.master')

@section('content')
    <div class="background-user-profile"></div>
    <div class="layout-wrapper layout-wrapper-profile">
        <!--page title-->
        <section class="fm-page-title title-profile-survey">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><a href="">
                            <span class="breadcrumb-arrow fa fa-angle-left"></span>
                        </a>@lang('lang.profile')</h2>
                    </div>
                </div>
            </div>
        </section>
        <!--/page title-->
        <div class="container">
            <div class="content-wrapper">
                <!--introduction video-->
                <div class="form-settings wrapper-profile">
                    <div class="row no-gutters mt-3">
                        <div class="col-lg-3">
                            <!--settings list-->
                            <ul class="installation-steps list-manage-profile">
                                <li>
                                    <a href="{{ route('survey.profile.index') }}" class="installation-link active">
                                        <span class="fa fa-user"></span>@lang('lang.profile')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('survey.profile.changepassword') }}" class="installation-link">
                                        <span class="fa fa-cog"></span>@lang('lang.change_password')
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="card content-card content-update-profile">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <h5>@lang('lang.profile')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 mb-3 card-body-profile">

                                    @include('survey.profile.notice')

                                    <h3 class="form-header">&#9758; @lang('lang.important_settings')</h3>
                                    {!! Form::open(['route' => ['survey.profile.update', $user->id],
                                        'class' => 'install-form', 'files' => true,
                                        'method' => 'put', 'id' => 'form-update-profile']) !!}
                                        <div class="form-group row">
                                            {!! Form::label('name', trans('lang.name'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('email', trans('lang.email'), ['class' => 'col-sm-3 col-form-label', 'required']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::email('email', $user->email, ['class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="form-header">&#9758; @lang('lang.general_settings')</h3>
                                        <div class="form-group row">
                                            {!! Form::label('image', trans('lang.avatar'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                <div class="profile-img">
                                                    {{ Html::image(asset($user->image)) }}
                                                </div>
                                                <div class="edit-image" id="change-avatar"><a href="#">@lang('lang.change')</a></div>
                                                {!! Form::file('image', ['id' => 'upload-avatar']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('gender', trans('lang.gender'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                <label class="container-radio">
                                                    {{ Form::radio('gender', config('users.gender.male'), '',
                                                        [($user->gender == config('users.gender.male')) ? 'checked' : null]) }}
                                                    @lang('lang.male')
                                                    <span class="radiobtn"></span>
                                                </label>
                                                <label class="container-radio">
                                                    {{ Form::radio('gender', config('users.gender.female'), '',
                                                        ['class' => 'form-group checkbox-gender', ($user->gender == config('users.gender.female')) ? 'checked' : null]) }}
                                                    @lang('lang.female')
                                                    <span class="radiobtn"></span>
                                                </label>
                                                <label class="container-radio">
                                                    {{ Form::radio('gender', config('users.gender.other_gender'), '',
                                                        ['class' => 'form-group checkbox-gender', ($user->gender == config('users.gender.other_gender')) ? 'checked' : null]) }}
                                                    @lang('lang.other')
                                                    <span class="radiobtn"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('birthday', trans('lang.birthday'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('birthday', $user->birthday, ['class' => 'calendar datepicker form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('phone', trans('lang.phone'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('address', trans('lang.address'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-7">
                                                <div class="align-btn">
                                                    {!! Form::button(trans('lang.update'), ['type' => 'submit', 'class' => 'btn btn-round btn-sm btn-secondary']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container wrapper -->
    </div>
@endsection
