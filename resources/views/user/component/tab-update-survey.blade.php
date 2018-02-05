<div class="detail-survey">
    {!! Form::open([
        'id' => 'wrapped-update',
        'class' => 'wizard-form',
        'action' => ['SurveyController@updateSurveyContent',
            $survey->id,
            $survey->token_manage
        ],
        'novalidate' => 'novalidate',
        'enctype' => 'multipart/form-data',
    ]) !!}
        <div class="update-content-survey wizard-branch wizard-wrapper">
            <div class="package-question step row wizard-step">
                <div class="title-create row">
                    <div class="col-md-9">
                        <h3 class="wizard-header">
                            @if (!$survey->update)
                                {{ trans('home.choose_question') }}
                            @else
                                {{ trans('home.edit_survey', [
                                    'limit' => (config('survey.maxEdit') - $survey->update),
                                ])}}
                            @endif
                        </h3>
                    </div>
                    <div class="col-md-3">
                        <span>
                            {{ Html::image(config('settings.image_path_system') . 'arrow-down1.png', '', [
                                'class' => 'animated bounceInDown'
                            ]) }}
                        </span>
                    </div>
                </div>
                <div class="wizard-hidden create-question-validate row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="alert alert-warning warning-center">
                            {{ trans('info.create_invalid') }}
                        </div>
                    </div>
                </div>
                <ul class="container-add-question">
                    <div class="add-question col-md-1"></div>
                    @foreach ($survey->questions as $question)
                        @if ($question->update >= 0)
                            @php
                                $number = $question->id;
                            @endphp
                            <li class="title-question animated zoomIn row question{{ $number }}"
                                question="{{ $number }}"
                                temp-qs="{{ count($question->answers) - 1 }}"
                                trash="{{ count($question->answers) }}">
                                <div>
                                    <div class="row">
                                        <div class="text-question col-md-10">
                                           {!! Form::textarea("txt-question[question][$number]", $question->content, [
                                                'class' => 'form-control textarea-question',
                                                'placeholder' => trans('home.enter_question_here'),
                                                'required' => true,
                                            ]) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="img-trash row">
                                                <a class="glyphicon glyphicon-picture col-md-3"></a>
                                                @include('temps.question_hidden_field')
                                                <a class="glyphicon glyphicon-trash col-md-1" id-question="{{ $number }}"></a>
                                                <a class="glyphicon glyphicon-sort col-md-3"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-image-question{{ $number }}
                                    {{ $question->image ? 'show-image-question' : 'div-image-question' }}
                                    animated slideInDown">
                                    {!! Html::image($question->image ?: config('temp.image_default'), '', [
                                        'class' => 'set-image image-question' . $number,
                                    ]) !!}
                                    <span class="remove-image-question glyphicon glyphicon-remove"
                                        id-question="{{ $number }}"
                                        data-id-image="{{ $number }}">
                                    </span>
                                </div>
                                @foreach ($question->answers as $answer)
                                    @php
                                        $numberAnswer = $loop->index;
                                    @endphp
                                    @if ($answer->update >= 0)
                                        @switch($answer->type)
                                        @case(config('survey.type_radio'))
                                            <div class="clear clear-as{{ $number . $loop->index }}"></div>
                                            <div class="div-content-answer qs-as{{ $number . $loop->index }}">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-1"><i class="fa fa-circle-o"></i></div>
                                                    <div class="col-md-9 col-xs-7">
                                                        <div class="div-text-answer">
                                                            {!! Form::textarea("txt-question[answers][$number][][" . config('survey.type_radio') . "]", $answer->content, [
                                                                'class' => 'form-control textarea-question',
                                                                'placeholder' => trans('home.enter_answer_here'),
                                                                'required' => true,
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="remove-answer col-md-2 col-xs-4">
                                                        {!! Html::image(config('settings.image_path_system') . 'img-answer.png', '', [
                                                            'class' => 'picture-answer',
                                                        ]) !!}
                                                        @include('temps.answer_hidden_field')
                                                        <a class="glyphicon glyphicon-remove btn-remove-answer"
                                                            id-as="{{ $number . $loop->index }}"
                                                            num="{{ $number  }}"
                                                            data-answerId="{{ $answer->id }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="content-image-answer{{ $number . $loop->index }}
                                                    {{ $answer->image ? 'show-image-answer' : 'div-image-answer' }}
                                                    show-update animated slideInDown">
                                                    {!! Html::image($answer->image ?: config('temp.image_default'), '', [
                                                        'class' => 'set-image-answer image-answer' . $number . $loop->index,
                                                    ]) !!}
                                                    <span class="remove-image-answer glyphicon glyphicon-remove"
                                                        id-answer="{{ $number . $loop->index }}"
                                                        data-answerId="{{ $answer->id }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_checkbox'))
                                            <div class="clear clear-as{{ $number }}"></div>
                                            <div class="div-content-answer qs-as{{ $number . $loop->index}}">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-1"><i class="fa fa-square-o"></i></div>
                                                    <div class="col-md-9 col-xs-7">
                                                        <div class="div-text-answer">
                                                            {!! Form::textarea("txt-question[answers][$number][][" . config('survey.type_checkbox') . "]", $answer->content, [
                                                                'class' => 'form-control textarea-question',
                                                                'placeholder' => trans('home.enter_answer_here'),
                                                                'required' => true,
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="remove-answer col-md-2 col-xs-4">
                                                        {!! Html::image(config('settings.image_path_system') . 'img-answer.png', '', [
                                                            'class' => 'picture-answer',
                                                        ]) !!}
                                                        @include('temps.answer_hidden_field')
                                                        <a class="glyphicon glyphicon-remove btn-remove-answer"
                                                            id-as="{{ $number . $loop->index}}"
                                                            num="{{ $number }}"
                                                            data-answerId="{{ $answer->id }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="content-image-answer{{ $number . $loop->index }}
                                                    {{ $answer->image ? 'show-image-answer' : 'div-image-answer' }}
                                                    show-update animated slideInDown">
                                                    {!! Html::image($answer->image ?: config('temp.image_default'), '', [
                                                        'class' => 'set-image-answer image-answer' . $number . $loop->index,
                                                    ]) !!}
                                                    <span class="remove-image-answer glyphicon glyphicon-remove"
                                                        id-answer="{{ $number . $loop->index }}"
                                                        data-answerId="{{ $answer->id }}">
                                                    </span>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_text'))
                                            <div class="clear"></div>
                                            <div class="div-content-answer container-text">
                                                <div class="div-clock col-md-1 col-xs-1"><i class="fa fa-file-text-o"></i></div>
                                                <div class="col-md-7 col-xs-10">
                                                    <div class="text-empty">
                                                        {!! Form::textarea("txt-question[answers][$number][][" . config('survey.type_text') . "]", '', [
                                                            'class' => 'form-control textarea-question',
                                                            'placeholder' => trans('temp.text'),
                                                            'readonly' => true,
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-12 div-required">
                                                    <div class="row">
                                                        <div class="col-md-5 col-xs-4 time-text">
                                                            <strong>{{ trans('temp.require') }}?</strong>
                                                        </div>
                                                        <div class="col-md-5 col-xs-5">
                                                            <div class="checkbox">
                                                                {{ Form::checkbox("checkboxRequired[question][$number]", $number, '', [
                                                                    'id' => 'text' . $number,
                                                                    $question->required ? ('checked = checked') : '',
                                                                ]) }}
                                                                {{ Form::label('text' . $number, ' ') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_time'))
                                            <div class="clear"></div>
                                            <div class="div-content-answer container-text">
                                                <div class="div-clock col-md-1 col-xs-1"><i class="fa fa-clock-o"></i></div>
                                                <div class="col-md-7 col-xs-10">
                                                    <div class="text-empty">
                                                        {!! Form::text("txt-question[answers][$number][][" . config('survey.type_time') . "]", '', [
                                                            'placeholder' => trans('temp.time_text'),
                                                            'readonly' => true,
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-12 div-required">
                                                    <div class="row">
                                                        <div class="col-md-5 col-xs-4 time-text">
                                                            <strong>{{ trans('temp.require') }}?</strong>
                                                        </div>
                                                        <div class="col-md-5 col-xs-5">
                                                            <div class="checkbox">
                                                               {{ Form::checkbox("checkboxRequired[question][$number]", $number, '', [
                                                                    'id' => 'time' . $number,
                                                                    $question->required ? ('checked = checked') : '',
                                                                ]) }}
                                                                {{ Form::label('time' . $number, ' ') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_date'))
                                            <div class="clear"></div>
                                            <div class="div-content-answer container-text">
                                                <div class="div-clock col-md-1 col-xs-1"><i class="fa fa-calendar-o"></i></div>
                                                <div class="col-md-7 col-xs-10">
                                                    <div class="text-empty">
                                                        {!! Form::text("txt-question[answers][$number][][" . config('survey.type_date') . "]", '', [
                                                            'placeholder' => trans('temp.date_month'),
                                                            'readonly' => true,
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-12 div-required">
                                                    <div class="row">
                                                        <div class="col-md-5 col-xs-4 time-text">
                                                            <strong>{{ trans('temp.require') }}?</strong>
                                                        </div>
                                                        <div class="col-md-5 col-xs-5">
                                                            <div class="checkbox">
                                                               {{ Form::checkbox("checkboxRequired[question][$number]", $number, '', [
                                                                    'id' => 'date' . $number,
                                                                    $question->required ? ('checked = checked') : '',
                                                                ]) }}
                                                                {{ Form::label('date' . $number, ' ') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_other_radio'))
                                            <div class="clear temp-other{{ $number }}"></div>
                                            <div class="temp div-content-answer answer-other{{ $number }}">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-1"><i class="fa fa-circle-o"></i></div>
                                                    <div class="col-md-9 col-xs-7">
                                                        <div class="container-text-other div-text-answer">
                                                            {!! Form::text("txt-question[answers][$number][][" . config('survey.type_other_radio') . "]", '', [
                                                                'readonly' => 'true',
                                                                'placeholder' => trans('home.other'),
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="remove-answer col-md-2 col-xs-2">
                                                        <a class="glyphicon glyphicon-remove remove-other"
                                                            id-qs="{{ $number }}"
                                                            num="{{ $number }}"
                                                            data-answerId="{{ $answer->id }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @case(config('survey.type_other_checkbox'))
                                            <div class="clear temp-other{{ $number }}"></div>
                                            <div class="temp div-content-answer answer-other{{ $number }}">
                                                <div class="row">
                                                    <div class="col-md-1 col-xs-1"><i class="fa fa-square-o"></i></div>
                                                    <div class="col-md-9 col-xs-7">
                                                        <div class="container-text-other div-text-answer">
                                                            {!! Form::text("txt-question[answers][$number][][" . config('survey.type_other_checkbox') . "]", '', [
                                                                'readonly' => 'true',
                                                                'placeholder' => trans('home.other'),
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="remove-answer btn-remove-answer col-md-2 col-xs-2">
                                                        <a class="glyphicon glyphicon-remove remove-other"
                                                            id-qs="{{ $number }}"
                                                            num="{{ $number }}"
                                                            data-answerId="{{ $answer->id }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @breakswitch
                                        @endswitch
                                    @endif
                                @endforeach
                                @if (in_array($question->answers->first()->type, [
                                        config('survey.type_radio'),
                                        config('survey.type_checkbox'),
                                    ]))
                                    <div class="clear temp-other{{ $number }}"></div>
                                    <div class="choose-action row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            @if ($question->answers->first()->type == config('survey.type_radio'))
                                                <span class="add-radio" id-as="{{ $number }}"
                                                    typeId="{{ config('survey.type_radio') }}"
                                                    url="{{ action('TempController@addTemp', config('temp.radio_answer')) }}">
                                                    {{ trans('home.add_option') }}
                                                </span>
                                                <span class="add-radio-other other{{ $number }}
                                                    {{ ($question->answers->last()->type == config('survey.type_other_radio')
                                                        && $question->answers->last()->update >=0) ? 'div-hidden' : '' }}"
                                                    typeId="{{ config('survey.type_other_radio') }}"
                                                    url="{{ action('TempController@addTemp', config('temp.other_radio')) }}">
                                                    <span class="span-other">{{ trans('home.or') }}</span>
                                                    {{ trans('home.add_other') }}
                                                </span>
                                            @else
                                                <span class="add-checkbox" id-as="{{ $number }}"
                                                    typeId="{{ config('survey.type_checkbox') }}"
                                                    url="{{ action('TempController@addTemp', config('temp.checkbox_answer')) }}">
                                                    {{ trans('home.add_option') }}
                                                </span>
                                                <span class="add-checkbox-other other{{ $number }}
                                                    {{ ($question->answers->last()->type == config('survey.type_other_checkbox')
                                                    && $question->answers->last()->update >=0) ? 'div-hidden' : '' }}"
                                                    typeId="{{ config('survey.type_other_checbox') }}"
                                                    url="{{ action('TempController@addTemp', config('temp.other_checkbox')) }}">
                                                    <span class="span-other">{{ trans('home.or') }}</span>
                                                    {{ trans('home.add_other') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3" class="div-require">
                                            <ul class="data-list">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6 col-xs-4 time-text">
                                                            <strong>{{ trans('temp.require') }}?</strong>
                                                        </div>
                                                        <div class="col-md-5 col-xs-4">
                                                            <div class="checkbox">
                                                                {{ Form::checkbox("checkboxRequired[question][$number]", $number, '', [
                                                                    'id' => 'radio' . $number,
                                                                    $question->required ? ('checked = checked') : '',
                                                                ]) }}
                                                                {{ Form::label('radio' . $number, ' ') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach
                    <div class="hide"></div>
                </ul>
                <div class="row">
                    <div class="col-md-2">
                        @if ($survey->update < config('survey.maxEdit'))
                            {!! Form::submit(trans('user.update'), [
                                'class' => 'btn-change-survey btn btn-info submit-answer',
                            ]) !!}
                        @endif
                    </div>
                    <div class="row col-md-4 col-md-offset-6 parent-option">
                        <div class="col-md-2 col-xs-2 col-md-offset-1 container-option-image">
                            <span class="span-option-1">
                                {{ trans('temp.one_choose') }}
                            </span>
                            {{ Html::image(config('settings.image_path_system') . 'radio.png', '', [
                                'class' => 'image-type-option',
                                'url' => action('TempController@addTemp', config('temp.radio_question')),
                                'id' => 'radio-button',
                                'typeId' => config('survey.type_radio'),
                            ]) }}
                        </div>
                        @include('user.blocks.list-button')
                    </div>
                    {!! Form::hidden('del-question', '') !!}
                    {!! Form::hidden('del-answer', '') !!}
                    {!! Form::hidden('del-question-image', '') !!}
                    {!! Form::hidden('del-answer-image', '') !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
