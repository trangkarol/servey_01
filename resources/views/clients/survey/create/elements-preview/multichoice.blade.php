@foreach ($question->answers as $answer)
    <div class="item-answer">
        @if ($answer->media)
            <div class="img-preview-answer-survey img-radio-preview">
                {!! Html::image($answer->media, '',
                    ['class' => 'img-answer']) !!}
            </div>
        @endif
        @if ($answer->type === config('settings.answer_type.other_option'))
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
