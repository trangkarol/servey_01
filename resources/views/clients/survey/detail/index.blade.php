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
        {!! Html::style(asset(config('settings.plugins') . 'bootstrap/dist/css/bootstrap.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'font-awesome/css/font-awesome.min.css')) !!}
        <!-- Theme CSS -->
        {!! Html::style(elixir(config('settings.public_template') . 'css/style.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
    </head>
    <body>
        <div class="background-user-profile"></div>
        @include('clients.survey.detail.detail_survey')
    </body>
</html>
