@extends('templates.survey.master')
@push('styles')
    {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
    {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
@endpush
@section('content')
    <div class="background-user-profile"></div>
    <!-- .cd-main-header -->
    <main class="cd-main-content">
        <!-- Content Wrapper  -->
        <div class="content-wrapper">
            {!! Form::open() !!}
                <!-- Scroll buttons -->
                <div class="scroll-button-group-sidebar">
                    <div class="button-group-sidebar">
                        <div class="survey-action">
                            <button class="btn btn-outline-light text-dark"><i class="fa fa-fw fa-plus-circle text-dark"></i></button>
                        </div>
                        <div class="survey-action">
                            <button class="btn btn-outline-light text-dark"><i class="fa fa-fw fa-header text-dark"></i></button>
                        </div>
                        <div class="survey-action">
                            <button class="btn btn-outline-light text-dark"><i class="fa fa-fw fa-picture-o text-dark"></i></button>
                        </div>
                        <div class="survey-action">
                            <button class="btn btn-outline-light text-dark"><i class="fa fa-fw fa-video-camera text-dark"></i></button>
                        </div>
                        <div class="survey-action">
                            <button class="btn btn-outline-light text-dark"><i class="fa fa-fw fa-bars text-dark"></i></button>
                        </div>
                    </div>
                </div>
                <!-- /Scroll buttons -->
                <ul class="clearfix form-wrapper page-section" id="sortable1">
                    <li class="form-line p-0 no-sort sortable-first">
                        <div class="form-line-actions remove-element"><i class="fa fa-close"></i></div>
                        <div class="form-header">
                            <h1>@lang('lang.survey')</h1>
                            <h4>@lang('lang.survey')</h4>
                        </div>
                    </li>
                    <li class="form-line">
                        <div class="form-line-actions remove-element"><i class="fa fa-close"></i></div>
                        <div class="form-row">
                            <div class="col">
                                {!! Form::text('name', '', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </li>
                </ul>
            {!! Form::close() !!}
        </div>
        <!-- Content Wrapper  -->
    </main>
@endsection
@push('scripts')
    <!-- Plugins -->
    {!! Html::script(asset(config('settings.plugins') . 'jquery-ui/jquery-ui.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/modernizr.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.plugins') . 'metismenu/metisMenu.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-menu-aim/jquery.menu-aim.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/builder-custom.js')) !!}
@endpush
