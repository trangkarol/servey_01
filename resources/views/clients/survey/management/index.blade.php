@extends ('clients.layout.master')

@push('styles')
    {!! Html::style(elixir(config('settings.public_template') . 'css/theme-styles.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/blocks.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'datatables/css/jquery.dataTables.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/datatables-custom.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'highcharts/highcharts.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/result.css')) !!}
       
    {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
    {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
@endpush

@section ('content')
    <div class="font-profile">
        @include('clients.profile.notice')
        <div class="container padding-profile background-container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ui-block">
                        <div class="top-header">
                            <div class="top-header-thumb image-background-profile">
                            </div>
                            <div class="profile-section">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 list-profile-menu">
                                        <ul class="profile-menu">
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="active menu-management" id="overview-survey"
                                                    data-url="{{ route('ajax-get-overview', $survey->token_manage) }}">
                                                    @lang('survey.overview')
                                                </a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)" class="menu-management" id="results-survey"
                                                    data-url="{{ route('survey.result.index', $survey->token_manage) }}">
                                                    @lang('survey.result')
                                                </a>
                                            </li>
                                           <li>
                                                <a href="javascript:void(0)" class="menu-management" id="setting-survey"
                                                    data-url="{{ route('ajax-setting-survey', $survey->token) }}">
                                                    @lang('survey.setting')
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- show list survey -->
        <div class="container ui-block padding-profile div-list-survey">
            <div class="ui-block-content" id="div-management-survey">
                @include('clients.survey.management.overview')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! Html::script(asset(config('settings.plugins') . 'datatables/js/jquery.dataTables.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/datatables-script.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts-3d.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/management-chart.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/result.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/management.js')) !!}
@endpush
