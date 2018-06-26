<!-- .cd-main-header -->
<main class="cd-main-content">
    <!-- Content Wrapper  -->
    <div class="content-wrapper content-wrapper-management">
        <!-- /Scroll buttons -->
        <ul class="clearfix form-wrapper content-margin-top-preview ul-result content-margin-top-management">
            <li class="form-line-title-survey-result">
                <div class="form-group-title-survey">
                    <h2 class="title-survey-result" data-placement="bottom" data-toggle="tooltip"
                        title="{{ $survey->showTitleTooltip() }}">
                        {!! nl2br(e($survey->limit_title)) !!}
                    </h2>
                </div>
                <div class="form-group">
                    <span class="description-survey">{!! nl2br(e($survey->description)) !!}</span>
                </div>
                <div class="row">
                    <div class="btn-group col-md-6 col-xs-12" role="group">
                        <a href="{{ route('survey.result.index', $survey->token_manage) }}"
                            class="btn btn-secondary-result-answer"
                            id="btn-summary-result"
                            data-url="{{ route('survey.result.index', $survey->token_manage) }}">
                            @lang('result.summary')
                        </a>
                        <a href="{{ route('survey.result.detail-result', $survey->token_manage) }}"
                            class="btn btn-secondary-result-answer btn-secondary-result-answer-actived"
                            id="btn-personal-result"
                            data-url="{{ route('survey.result.detail-result', $survey->token_manage) }}">
                            @lang('result.personal')
                        </a>
                    </div>
                    @if ($countResult)
                        <div class="btn-export-excel col-md-6 col-xs-12">
                            <div class="action-view-detail-answer">
                                <a class="preview-answer-detail" href="#">❮</a>
                                <input value="{{ $pageCurrent }}" type="number" name="" class="page-answer-detail">
                                <span>/</span>
                                <span class="count-result">{{ $countResult }}</span>
                                <a class="next-answer-detail" href="#">❯</a>
                            </div>
                        </div>
                        @if ($survey->required != config('settings.survey_setting.answer_required.none'))
                            @php
                                $email = $details->first()->first()->user
                                    ? $details->first()->first()->user->email : trans('lang.incognito');
                            @endphp
                            <div class="col-md-12 col-xs-12">
                                <span class="show-email-result">@lang('lang.email'): {{ $email }}</span>
                            </div>
                        @endif
                    @endif
                </div>
            </li>
        </ul>
        <div class="content-section-preview">
            @if (!$countResult)
                <ul class="clearfix form-wrapper ul-result wrapper-section-result unset-max-with">
                    <li class="li-question-review form-line">
                        <span class="message-result">@lang('pagination.empty_data')</span>
                    </li>
                </ul>
            @else
                @foreach ($survey->sections as $section)
                    <ul class="clearfix form-wrapper ul-result wrapper-section-result unset-max-with">
                        <li class="p-0">
                            <div class="form-header">
                                <div class="section-badge section-option-menu">
                                    <span class="number-of-section">@lang('lang.section')
                                        <span class="section-index">{{ $loop->iteration }}</span> /
                                        <span class="total-section"></span>{{ count($survey->sections) }}
                                    </span>
                                    <div class="right-header-section">
                                        <a href="#" class="zoom-in-btn zoom-btn zoom-btn-result">
                                            <span class="zoom-icon"></span>
                                        </a>
                                    </div>
                                </div>
                                <hr/>
                                <h3 class="title-section" data-placement="bottom" data-toggle="tooltip"
                                    title="{{ $section->showTitleTooltip() }}">
                                    {!! nl2br(e($section->limit_title)) !!}
                                </h3>
                                <span class="description-section-result">
                                    {!! nl2br(e($section->custom_description)) !!}
                                </span>
                            </div>
                        </li>
                    </ul>
                    <ul class="clearfix form-wrapper ul-result unset-max-with content-section-result">
                        @php
                            $indexQuestion = config('settings.number_0');
                        @endphp
                        @foreach ($section->questions as $question)
                            @php
                                $questionSetting = $question->type;
                                $countQuestionMedia = $question->media->count();
                                $detailResult = $questionSetting != config('settings.question_type.checkboxes')
                                    ? $details->first()->where('question_id', $question->id)->first()
                                    : $details->first()->where('question_id', $question->id);
                            @endphp
                            <li class="li-question-review form-line">
                                <!-- tittle -->
                                @if ($questionSetting == config('settings.question_type.title'))
                                    @include ('clients.survey.result.elements.title')
                                <!-- video -->
                                @elseif ($questionSetting == config('settings.question_type.video'))
                                    @include ('clients.survey.result.elements.video')
                                <!-- image -->
                                @elseif ($questionSetting == config('settings.question_type.image'))
                                    @include ('clients.survey.result.elements.image')
                                @else
                                    <span class="index-question">{{ ++ $indexQuestion }}</span>
                                    <h4 class="title-question question-survey {{ $question->required ? 'required-question' : '' }}"
                                        data-type="{{ $questionSetting }}" data-id="{{ $question->id }}"
                                        data-required="{{ $question->required }}">
                                        {!! nl2br(e($question->title)) !!}
                                        @if ($question->required)
                                            <span class="notice-required-question"> *</span>
                                        @endif
                                    </h4>
                                    <div class="form-group form-description">
                                        <span class="description-question">
                                            {!! nl2br(e($question->description)) !!}
                                        </span>
                                    </div>
                                    @if ($countQuestionMedia)
                                        <div class="img-preview-question-survey">
                                            {!! Html::image($question->url_media) !!}
                                        </div>
                                    @endif
                                    <!-- short answer -->
                                    @if ($questionSetting == config('settings.question_type.short_answer'))
                                        @include ('clients.survey.result.elements.short-question')
                                    <!-- long answer -->
                                    @elseif ($questionSetting == config('settings.question_type.long_answer'))
                                        @include ('clients.survey.result.elements.long-question')
                                    <!-- multi choice -->
                                    @elseif ($questionSetting == config('settings.question_type.multiple_choice'))
                                        @include ('clients.survey.result.elements.multiple-choice')
                                    <!-- check boxes -->
                                    @elseif ($questionSetting == config('settings.question_type.checkboxes'))
                                        @include ('clients.survey.result.elements.checkboxes')
                                    <!-- date -->
                                    @elseif ($questionSetting == config('settings.question_type.date'))
                                        @include ('clients.survey.result.elements.date')
                                    <!-- time -->
                                    @elseif ($questionSetting == config('settings.question_type.time'))
                                        @include ('clients.survey.result.elements.time')
                                    @endif
                                @endif
                                @if ($question->required)
                                    <div class="notice-required">@lang('lang.question_required')</div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Content Wrapper  -->
</main>
