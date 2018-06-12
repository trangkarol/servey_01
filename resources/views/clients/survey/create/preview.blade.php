@extends('clients.layout.master')
@push('styles')
    {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
    {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/preview.css')) !!}
@endpush
@section('content')
    <div class="background-user-profile"></div>
    <!-- .cd-main-header -->
    <main class="cd-main-content">
        <div class="image-header"></div>
        <!-- Content Wrapper  -->
        <div class="content-wrapper">
            <!-- /Scroll buttons -->
            {!! Form::open() !!}
                <ul class="clearfix form-wrapper content-margin-top-preview ul-preview">
                    <li class="form-line">
                        <div class="form-group">
                            <h2 class="title-survey-preview">{{ $survey->title }}</h2>
                        </div>
                        <div class="form-group">
                            <span>{{ $survey->description }}</span>
                        </div>
                    </li>
                    <li class="form-line content-title-section">
                        <div class="form-group">
                            <h3 class="title-section">{{ $section->title }}</h3>
                        </div>
                        <div class="form-group form-group-description-section">
                            <span class="description-section">{{ $section->description }}</span>
                        </div>
                    </li>
                </ul>
                <div class="content-section-preview">
                    <ul class="clearfix form-wrapper ul-preview">
                        @php
                            $indexQuestion = config('settings.number_0');
                        @endphp
                        @foreach ($section->questions as $question)
                            <li class="li-question-review form-line">
                                <!-- tittle -->
                                @if ($question->type === config('settings.question_type.title'))
                                    @include ('clients.survey.create.elements-preview.title')
                                <!-- video -->
                                @elseif ($question->type === config('settings.question_type.video'))
                                    @include ('clients.survey.create.elements-preview.video')
                                <!-- image -->
                                @elseif ($question->type === config('settings.question_type.image'))
                                    @include ('clients.survey.create.elements-preview.image')
                                @else
                                    <h4 class="title-question">
                                        <span class="index-question">{{ ++ $indexQuestion}}</span>{{ $question->title }}
                                        @if ($question->require)
                                            <span class="notice-required-question"> *</span>
                                        @endif
                                    </h4>
                                    <div class="form-group">
                                        <span>{{ $question->description }}</span>
                                    </div>
                                    @if ($question->media)
                                        <div class="img-preview-question-survey">
                                            {!! Html::image($question->media) !!}
                                        </div>
                                    @endif
                                    <!-- short answer -->
                                    @if ($question->type === config('settings.question_type.short_answer'))
                                        @include ('clients.survey.create.elements-preview.short')
                                    <!-- long answer -->
                                    @elseif ($question->type === config('settings.question_type.long_answer'))
                                        @include ('clients.survey.create.elements-preview.long')
                                    <!-- multi choice -->
                                    @elseif ($question->type === config('settings.question_type.multiple_choice'))
                                        @include ('clients.survey.create.elements-preview.multichoice')
                                    <!-- check boxes -->
                                    @elseif ($question->type === config('settings.question_type.checkboxes'))
                                        @include ('clients.survey.create.elements-preview.checkboxes')
                                    <!-- date -->
                                    @elseif ($question->type === config('settings.question_type.date'))
                                        @include ('clients.survey.create.elements-preview.date')
                                    <!-- time -->
                                    @elseif ($question->type === config('settings.question_type.time'))
                                        @include ('clients.survey.create.elements-preview.time')
                                    @endif
                                @endif
                            </li>
                        @endforeach

                        <li class="li-question-review form-line">
                            @if ($numOfSection > config('settings.number_1'))
                                @if (config('settings.number_0') !== $currentSection)
                                    <a href="{{ route('survey.create.preview.previous') }}"
                                        class="btn-action-preview btn-action-preview-survey">@lang('lang.previous')</a>
                                @endif
                                @if ($numOfSection - config('settings.number_1') !== $currentSection)
                                    <a href="{{ route('survey.create.preview.next') }}"
                                        class="btn-action-preview btn-action-preview-survey">@lang('lang.next')</a>
                                @endif
                            @endif
                        </li>
                    </ul>
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
    {!! Html::script(elixir(config('settings.public_template') . 'js/preview-doing.js')) !!}
@endpush
