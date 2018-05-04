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
        <div class="image-header">
            {!! Html::image(asset(Auth::user()->background)) !!}
        </div>
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
                            <span class="description-survey">{{ $survey->description }}</span>
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
                            @php
                                $questionSetting = $question->type;
                                $countQuestionMedia = $question->media->count();
                            @endphp
                            <li class="li-question-review form-line">
                                <!-- tittle -->
                                @if ($questionSetting == config('settings.question_type.title'))
                                    <div class="title-question-preview">
                                        <span>{{ $question->title }}</span>
                                    </div>
                                    <div class="form-group form-group-description-section">
                                        <span class="description-section">{{ $question->description }}</span>
                                    </div>
                                <!-- video -->
                                @elseif ($questionSetting == config('settings.question_type.video'))
                                    <h4 class="title-question">{{ $question->title }}</h4>

                                    @if ($countQuestionMedia)
                                        <div class="img-preview-question-survey videoWrapper">
                                            <iframe src="{{ $question->url_media }}"
                                                frameborder="0">
                                            </iframe>
                                        </div>
                                    @endif

                                    <div class="form-group form-group-description-section">
                                        <span class="description-question">{{ $question->description }}</span>
                                    </div>
                                <!-- image -->
                                @elseif ($questionSetting == config('settings.question_type.image'))
                                    <h4 class="title-question">{{ $question->title }}</h4>
                                    <div class="img-preview-question-survey">
                                        {!! Html::image($question->url_media, '', ['title' => $question->description]) !!}
                                    </div>
                                @else
                                    <h4 class="title-question">
                                        <span class="index-question">{{ ++ $indexQuestion}}</span>{{ $question->title }}
                                    </h4>
                                    <div class="form-group">
                                        <span class="description-question">{{ $question->description }}</span>
                                    </div>
                                    @if ($countQuestionMedia)
                                        <div class="img-preview-question-survey">
                                            {!! Html::image($question->url_media) !!}
                                        </div>
                                    @endif
                                    <!-- short answer -->
                                    @if ($questionSetting == config('settings.question_type.short_answer'))
                                        <div class="item-answer">
                                            <div class="magic-box-preview short-answer-preview">
                                                {!! Form::textarea('', '', ['class' => 'input-answer-other auto-resize',
                                                    'data-autoresize', 'rows' => 1,
                                                    'placeholder' => trans('lang.your_answer')]) !!}
                                            </div>
                                        </div>
                                    <!-- long answer -->
                                    @elseif ($questionSetting == config('settings.question_type.long_answer'))
                                        <div class="item-answer">
                                            <div class="magic-box-preview long-answer-preview">
                                                {!! Form::textarea('', '', ['class' => 'input-answer-other auto-resize',
                                                    'data-autoresize', 'rows' => 1,
                                                    'placeholder' => trans('lang.your_answer')]) !!}
                                            </div>
                                        </div>
                                    <!-- multi choice -->
                                    @elseif ($questionSetting == config('settings.question_type.multiple_choice'))
                                        @foreach ($question->answers as $answer)
                                            <div class="item-answer">
                                                @if ($answer->media->count())
                                                    <div class="img-preview-answer-survey img-radio-preview">
                                                        {!! Html::image($answer->url_media, '',
                                                            ['class' => 'img-answer']) !!}
                                                    </div>
                                                @endif
                                                @if ($answer->type == config('settings.anser_type.option_other'))
                                                    <label class="container-radio-setting-survey">@lang('lang.other')
                                                        {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                                        <span class="checkmark-radio"></span>
                                                    </label>
                                                    <div class="magic-box-preview">
                                                        {!! Form::text('', '', ['class' => 'input-answer-other input-multiple-choice-other']) !!}
                                                    </div>
                                                @else
                                                    <label class="container-radio-setting-survey">{{ $answer->content }}
                                                        {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                                        <span class="checkmark-radio"></span>
                                                    </label>
                                                @endif
                                            </div>
                                        @endforeach
                                    <!-- check boxes -->
                                    @elseif ($questionSetting == config('settings.question_type.checkboxes'))
                                        @foreach ($question->answers as $answer)
                                            <div class="item-answer">
                                                @if ($answer->media->count())
                                                    <div class="img-preview-answer-survey img-checkbox-preview">
                                                        {!! Html::image($answer->url_media, '',
                                                            ['class' => 'img-answer']) !!}
                                                    </div>
                                                @endif
                                                @if ($answer->type == config('settings.anser_type.option_other'))
                                                    <label class="container-checkbox-setting-survey">
                                                        <span>@lang('lang.other')</span>
                                                        {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                                        <span class="checkmark-setting-survey"></span>
                                                    </label>
                                                    <div class="magic-box-preview">
                                                        {!! Form::text('', '', ['class' => 'input-answer-other input-checkbox-other']) !!}
                                                    </div>
                                                @else
                                                    <label class="container-checkbox-setting-survey">
                                                        <span>{{ $answer->content }}</span>
                                                        {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                                        <span class="checkmark-setting-survey"></span>
                                                    </label>
                                                @endif
                                            </div>
                                        @endforeach
                                    <!-- date -->
                                    @elseif ($questionSetting == config('settings.question_type.date'))
                                        <div class="item-answer">
                                            <span class="description-date-time">@lang('lang.date') :</span>
                                            <div class="input-group date">
                                                <input type="text" class="input-answer-other datetimepicker-input date-answer-preview"
                                                    id="datepicker-preview" data-toggle="datetimepicker" locale="{{ Session::get('locale') }}"
                                                    data-target="#datepicker-preview" placeholder="@lang('lang.date_placeholder')" />
                                            </div>
                                        </div>
                                    <!-- time -->
                                    @elseif ($questionSetting == config('settings.question_type.time'))
                                        <div class="item-answer">
                                            <span class="description-date-time">@lang('lang.hour') :</span>
                                            <div class="input-group date">
                                                <input type="text" class="input-answer-other datetimepicker-input time-answer-preview"
                                                    id="timepicker-preview" data-toggle="datetimepicker"
                                                    data-target="#timepicker-preview" placeholder="@lang('lang.time_placeholder')" />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </li>
                        @endforeach

                        <li class="li-question-review form-line">
                            @if ($currentSection > config('settings.section_order_default'))
                                <a href="{{ route('survey.create.previous-section-survey', $survey->token) }}"
                                    class="btn-action-preview">@lang('lang.previous')</a>
                            @endif
                            @if ($numOfSection > $currentSection)
                                <a href="{{ route('survey.create.next-section-survey', $survey->token) }}"
                                    class="btn-action-preview">@lang('lang.next')</a>
                            @endif
                            @if ($numOfSection == $currentSection || $numOfSection == config('settings.number_1'))
                                {!! Form::button(trans('profile.send'), ['class' => 'btn-action-preview btn-action-preview-submit']) !!}
                            @endif
                        </li>
                    </ul>
                </div>
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
    {!! Html::script(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.plugins') . 'metismenu/metisMenu.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-menu-aim/jquery.menu-aim.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/preview.js')) !!}
@endpush
