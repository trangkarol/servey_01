@foreach ($question->answers as $answer)
    <div class="item-answer" data-id="{{ $answer->id }}" data-type="{{ $answer->type }}">
        @if ($answer->media->count())
            <div class="img-preview-answer-survey img-checkbox-preview">
                {!! Html::image($answer->url_media, '',
                    ['class' => 'img-answer']) !!}
            </div>
        @endif
        @if ($answer->type == config('settings.answer_type.other_option'))
            <label class="container-checkbox-setting-survey">
                <span>@lang('lang.other')</span>
                {!! Form::checkbox('answer' . $question->id, '', false, ['class' => 'choice-answer checkbox-answer-preview']) !!}
                <span class="checkmark-setting-survey"></span>
            </label>
            <div class="magic-box-preview">
                {!! Form::text('', '', ['class' => 'option-other input-answer-other input-checkbox-other']) !!}
            </div>
        @else
            <label class="container-checkbox-setting-survey">
                {!! nl2br(e($answer->content)) !!}
                {!! Form::checkbox('answer' . $question->id, '', false, ['class' => 'choice-answer checkbox-answer-preview']) !!}
                <span class="checkmark-setting-survey"></span>
            </label>
        @endif
    </div>
@endforeach
