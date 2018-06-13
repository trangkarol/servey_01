@foreach ($question->answers as $answer)
    <div class="item-answer">
        @if ($answer->media)
            <div class="img-preview-answer-survey img-checkbox-preview">
                {!! Html::image($answer->media, '',
                    ['class' => 'img-answer']) !!}
            </div>
        @endif
        @if ($answer->type === config('settings.answer_type.other_option'))
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
