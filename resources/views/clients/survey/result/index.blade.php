@extends('clients.layout.master')
@push('styles')
    {!! Html::style(asset(config('settings.plugins') . 'highcharts/highcharts.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/result.css')) !!}
@endpush
@section('content')
    @include('clients.survey.result.content_result')
@endsection
@push('scripts')
    <!-- Plugins -->
    {!! Html::script(asset(config('settings.plugins') . 'jquery-ui/jquery-ui.min.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts-3d.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'popper/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'bootstrap/dist/js/bootstrap.min.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/result.js')) !!}
@endpush
