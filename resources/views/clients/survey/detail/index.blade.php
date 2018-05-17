<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@lang('lang.web_title')</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Plugins CSS -->
        {!! Html::style(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'font-awesome/css/font-awesome.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'ionicons/css/ionicons.min.css')) !!}
        <!-- Theme CSS -->
        {!! Html::style(elixir(config('settings.public_template') . 'css/style.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
        {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
    </head>
    <body>
        <div class="background-user-profile"></div>
        <!-- .cd-main-header -->
        <main class="cd-main-content">
            <div class="image-header"></div>
            <!-- Content Wrapper  -->
            <div class="content-wrapper" id="user-id" data-user-id="{{ Auth::user()->id }}">
                <!-- /Scroll buttons -->
                {!! Form::open(['class' => 'form-doing-survey']) !!}
                    <ul class="clearfix form-wrapper content-margin-top-preview ul-preview">
                        <li class="form-line">
                            <div class="form-group">
                                <h2 class="title-survey-preview" id="id-survey-preview" data-token="{{ $survey->token }}">
                                    {{ $survey->title }}
                                </h2>
                            </div>
                            <div class="form-group">
                                <span class="description-survey">{{ $survey->description }}</span>
                            </div>
                        </li>
                    </ul>
                    <div class="content-section-preview">
                        @include ('clients.survey.detail.content-survey')
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- Content Wrapper  -->
        </main>
        <div class="modal fade" id="loader-section-survey-doing">
            <section>
                <div class="loader-spin">
                    <div class="loader-outter-spin"></div>
                    <div class="loader-inner-spin"></div>
                </div>
            </section>
        </div>
    </body>
    <!-- Plugins -->
    {!! Html::script(asset(config('settings.plugins') . 'jquery/jquery.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'moment/moment-with-locales.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'sweetalert/dist/sweetalert.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-ui/jquery-ui.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'metismenu/metisMenu.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-menu-aim/jquery.menu-aim.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'popper/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-validation/jquery.validate.min.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.public_template') . 'js/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/modernizr.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/preview.js')) !!}
</html>
