@extends('user.master')
@section('content')
    <div id="survey_container" class="survey_container animated zoomIn wizard" novalidate="novalidate">
        <div id="top-wizard">
            <div class="container-menu-wizard row">
                <div class="menu-wizard col-md-10 active-answer active-menu">
                    {{ trans('home.list_survey') }}
                </div>
            </div>
        </div>
        <div class="container-list-answer">
            <div class="middle-content-detail wizard-branch wizard-wrapper">
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
                <div class="div-table-list" style="">
                    <div class="table-list-row row">
                        <div class="col-md-3">
                            <ul class="nav nav-tabs tabs-left sideways">
                                <li class=" active">
                                    <a href="#home-v" data-toggle="tab" style="">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                        {{ trans('home.your_survey') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#profile-v" data-toggle="tab">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                        {{ trans('home.survey_invited') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#messages-v" data-toggle="tab">
                                        <span class="glyphicon glyphicon-dashboard"></span>
                                        {{ trans('home.survey_closed') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                          <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-v">
                                    @include('user.pages.your_survey')
                                </div>
                                <div class="tab-pane" id="profile-v">
                                    @include('user.pages.list-invited')
                                </div>
                                <div class="tab-pane" id="messages-v">
                                    @include('user.pages.list_survey_close')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bottom-wizard bottom-wizard-anwser"></div>
        </div>
    </div>
@endsection
