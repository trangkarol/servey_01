@foreach ($question->answers as $answer)
    <div class="item-answer" data-id="{{ $answer->id }}" data-type="{{ $answer->type }}">
        @if ($answer->media->count())
            <div class="img-preview-answer-survey img-radio-preview
                {{ $detailResult->answer_id ==  $answer->id ? 'image-active-result' : '' }}">
                {!! Html::image($answer->url_media, '',
                    ['class' => 'img-answer']) !!}
            </div>
        @endif
        @if ($answer->type == config('settings.answer_type.other_option'))
            <label class="container-radio-setting-survey block-hover">@lang('lang.other')
                {!! Form::radio('answer' . $question->id,
                    '',
                    $detailResult->answer_id ==  $answer->id ? true : false,
                    ['class' => 'choice-answer radio-answer-preview']) !!}
                <span class="checkmark-radio"></span>
            </label>
            <div class="magic-box-preview">
                {!! Form::text('',
                    $detailResult->answer_id ==  $answer->id ? $detailResult->content : '',
                    ['class' => 'option-other input-answer-other input-multiple-choice-other', 'disabled']) !!}
            </div>
        @else
            <label class="container-radio-setting-survey block-hover">
                {!! nl2br(e($answer->content)) !!}
                {!! Form::radio('answer' . $question->id,
                    '',
                    $detailResult->answer_id ==  $answer->id ? true : false,
                    ['class' => 'choice-answer radio-answer-preview', 'disabled']) !!}
                <span class="checkmark-radio"></span>
            </label>
        @endif
    </div>
@endforeach
