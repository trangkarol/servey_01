@extends('clients.layout.master')
@push('styles')
    {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'highcharts/highcharts.css')) !!}
    {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/result.css')) !!}
@endpush
@section('content')
    <div class="background-user-profile"></div>
    <!-- .cd-main-header -->
    <main class="cd-main-content">
        @include('clients.profile.notice')
        <div class="content-wrapper">
            <!-- /Scroll buttons -->
            <ul class="clearfix form-wrapper content-margin-top-preview ul-result">
                <li class="form-line-title-survey-result">
                    <div class="form-group-title-survey">
                        <h2 class="title-survey-result" data-placement="bottom" data-toggle="tooltip"
                                title="{{ $survey->title }}">
                            {{ ucfirst(str_limit($survey->title, config('settings.title_length_default'))) }}
                        </h2>
                    </div>
                    <div class="form-group">
                        <span>@lang('result.number_answer')</span>
                    </div>
                    <div class="row">
                        <div class="btn-group col-md-6 col-xs-9" role="group">
                            <a href="{{ route('survey.result.index', $survey->token) }}" class="btn btn-secondary-result-answer
                                btn-secondary-result-answer-actived">@lang('result.summary')</a>
                            <a href="" class="btn btn-secondary-result-answer">@lang('result.personal')</a>
                        </div>
                        <div class="btn-export-excel col-md-6 col-xs-3">
                            <a href="#" class="option-menu" id="export-file-excel" data-toggle="modal" data-target="#rename-excel"
                                data-url="{{ route('export-result', [$survey->token, '', '']) }}"
                                title="@lang('lang.export_excel')">
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- The Modal -->
            <div class="modal fade" id="rename-excel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">@lang('lang.export_excel')</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        {{ Form::open(['class' => 'info-export']) }}
                            <div class="modal-body">
                                <div class="content-pupup-export">
                                    <div class="form-group">
                                        <label for="name">@lang('lang.name')</label>
                                        {{ Form::text('name', str_limit($survey->title, config('settings.limit_title_excel')),
                                            ['class' => 'form-control name-file-export',
                                            'data-name' => str_limit($survey->title, config('settings.limit_title_excel'))]) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="type">@lang('lang.type')</label>
                                        {{ Form::select('type', ['xls' => '.xls', 'csv' => '.csv'], 'xls',
                                            ['class' => 'form-control type-file-export']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="footer-pupup-export">
                                    {{ Form::button(trans('lang.exit'), ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) }}
                                    {{ Form::button(trans('lang.export'),
                                        ['class' => 'btn btn-info submit-export-excel', 'data-dismiss' => 'modal']) }}
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="content-section-preview">
                @foreach ($resultsSurveys as $resultsSurvey)
                    <ul class="clearfix form-wrapper ul-result wrapper-section-result">
                        <li class="p-0">
                            <div class="form-header">
                                <div class="section-badge section-option-menu">
                                    <span class="number-of-section">@lang('lang.section')
                                        <span class="section-index">{{ $loop->iteration }}</span> /
                                        <span class="total-section"></span>{{ count($resultsSurveys) }}
                                    </span>
                                    <div class="right-header-section">
                                        <a href="" class="zoom-in-btn zoom-btn zoom-btn-result">
                                            <span class="zoom-icon"></span>
                                        </a>
                                    </div>
                                </div>
                                <hr/>
                                <h3 class="title-section" data-placement="bottom" data-toggle="tooltip"
                                    title="{{ $resultsSurvey['section']->title }}">
                                    {{ ucfirst(str_limit($resultsSurvey['section']->title, config('settings.title_length_default'))) }}
                                </h3>
                                <span class="description-section-result">{{ ucfirst($resultsSurvey['section']->description) }}</span>
                            </div>
                        </li>
                    </ul>
                    <ul class="clearfix form-wrapper ul-result content-section-result">
                        @php
                            $indexQuestion = 0;
                        @endphp

                        @foreach ($resultsSurvey['question_result'] as $result)
                            <li class="li-question-review form-line li-question-result">
                                @if ($result['question_type'] == config('settings.question_type.title'))
                                    <div class="title-question-preview">
                                        <span>{{ $result['question']->title }}</span>
                                    </div>
                                    <div class="form-group form-group-description-section">
                                        <span class="description-section">{{ $result['question']->description }}</span>
                                    </div>
                                @else
                                    <h4 class="title-question">
                                        <span class="index-question">{{ ++ $indexQuestion }}</span>{{ $result['question']->title }}
                                        @if ($result['question']->required)
                                            <span class="notice-required-question"> *</span>
                                        @endif
                                    </h4>
                                    <div class="form-group form-group-description-section">
                                        <span class="number-result-answer">{{ $result['count_answer'] }} @lang('result.number_answer')</span>
                                    </div>
                                    @if ($result['answers'])
                                        @if (in_array($result['question']->type, [
                                                config('settings.question_type.short_answer'),
                                                config('settings.question_type.long_answer'),
                                                config('settings.question_type.date'),
                                                config('settings.question_type.time'),
                                            ]))
                                            <div class="answer-result scroll-answer-result" id="style-scroll-3">
                                                @foreach ($result['answers'] as $answer)
                                                    <p class="{{ ($loop->iteration % config('settings.checkEventOdd')) ?
                                                        'item-answer-result-even' :
                                                        'item-answer-result-odd' }}"
                                                        data-placement="bottom" data-toggle="tooltip"
                                                        title="{{ $answer['content'] }}">
                                                        {{ str_limit($answer['content'], config('settings.limit_answer_content')) }}
                                                        <span class="percent-answer">({{ $answer['percent'] }}%)</span>
                                                    </p>
                                                @endforeach
                                            </div>
                                        @elseif ($result['question_type'] == config('settings.question_type.multiple_choice'))
                                            @if ($result['question']->answers->count())
                                                <div class="answer-result chart-result-answer multiple-choice-result"
                                                id="{{ $result['question']->id }}"
                                                data="{{ json_encode($result['answers']) }}"></div>
                                            @endif
                                        @elseif ($result['question_type'] == config('settings.question_type.checkboxes'))
                                            @if ($result['question']->answers->count())
                                                <div class="answer-result chart-result-answer checkboxes-result"
                                                    id="{{ $result['question']->id }}"
                                                    data="{{ json_encode($result['answers']) }}"></div>
                                            @endif
                                        @endif
                                    @else
                                        <span class="no-answer">@lang('result.there_is_no_result')</span>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
        <!-- Content Wrapper  -->
    </main>
@endsection
@push('scripts')
    <!-- Plugins -->
    {!! Html::script(asset(config('settings.plugins') . 'jquery-ui/jquery-ui.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/modernizr.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.plugins') . 'metismenu/metisMenu.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-menu-aim/jquery.menu-aim.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/highcharts-3d.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/modules/exporting.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'highcharts/modules/export-data.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'popper/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/result.js')) !!}
@endpush
