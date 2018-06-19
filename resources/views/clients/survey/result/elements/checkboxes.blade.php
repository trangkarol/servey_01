@foreach ($question->answers as $answer)
    <div class="item-answer" data-id="{{ $answer->id }}" data-type="{{ $answer->type }}">
        @if ($answer->media->count())
            <div class="img-preview-answer-survey img-checkbox-preview
                {{ $detailResult->answer_id ==  $answer->id ? 'image-active-result' : '' }}">
                {!! Html::image($answer->url_media, '',
                    ['class' => 'img-answer']) !!}
            </div>
        @endif
        @if ($answer->type == config('settings.answer_type.other_option'))
            <label class="container-checkbox-setting-survey block-hover">
                <span>@lang('lang.other')</span>
                {!! Form::checkbox('answer' . $question->id,
                    '',
                    $detailResult->answer_id ==  $answer->id ? true : false,
                    ['class' => 'choice-answer checkbox-answer-preview']) !!}
                <span class="checkmark-setting-survey"></span>
            </label>
            <div class="magic-box-preview">
                {!! Form::text('', $detailResult->answer_id ==  $answer->id ? $detailResult->content : '',
                    ['class' => 'option-other input-answer-other input-checkbox-other', 'disabled']) !!}
            </div>
        @else
            <label class="container-checkbox-setting-survey block-hover">
                <span>{!! nl2br(e($answer->content)) !!}</span>
                {!! Form::checkbox('answer' . $question->id,
                    '',
                    $detailResult->answer_id ==  $answer->id ? true : false,
                    ['class' => 'choice-answer checkbox-answer-preview', 'disabled']) !!}
                <span class="checkmark-setting-survey"></span>
            </label>
        @endif
    </div>
@endforeach
