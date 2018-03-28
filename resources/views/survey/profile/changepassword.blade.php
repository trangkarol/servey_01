@extends('templates.survey.master')

@section('content')
    <div class="background-user-profile"></div>
    <div class="layout-wrapper layout-wrapper-profile">
        <!--page title-->
        <section class="fm-page-title title-profile-survey">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            <a href=""><span class="breadcrumb-arrow fa fa-angle-left"></span></a>
                            @lang('lang.profile')
                        </h2> 
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
                                    <a href="{{ route('survey.profile.index') }}" class="installation-link">
                                        <span class="fa fa-user"></span>@lang('lang.profile')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('survey.profile.changepassword') }}" class="installation-link active">
                                        <span class="fa fa-cog"></span>@lang('lang.changePassword')
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="card content-card content-update-profile">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <h5>@lang('lang.changePassword')</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-3 mb-3">

                                    @include('survey.profile.notice')
                                    
                                    {!! Form::open(['class' => 'install-form']) !!}
                                        <div class="form-group row">
                                            {!! Form::label('oldpassword', trans('lang.oldPassword'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::password('oldpassword', ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('newpassword', trans('lang.newPassword'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::password('newpassword', ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {!! Form::label('retypepassword', trans('lang.reTypePassword'), ['class' => 'col-sm-3 col-form-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::password('retypepassword', ['class' => 'form-control', 'required']) !!}
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
