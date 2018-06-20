@include('clients.survey.edit.elements.element-header')
<div class="col-12 multiple-choice-block">
    @php
        $existsOtherOption = false;
    @endphp
    @foreach ($question->answers->sortBy('type') as $answer)
        @if ($answer->settings->count() && $answer->settings->first()->key == config('settings.answer_type.option'))
            <div class="form-row option choice choice-sortable"
                id="answer_{{ $answer->id }}"
                data-answer-id="{{ $answer->id }}"
                data-option-id="{{ $loop->iteration }}">
                <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 choice-input-block">
                    {!! Form::textarea("answer[question_$question->id][answer_$answer->id][option_$loop->iteration]", $answer->content, [
                        'class' => 'form-control auto-resize answer-option-input',
                        'data-autoresize',
                        'rows' => 1,
                    ]) !!}
                    {!! Form::hidden("media[question_$question->id][answer_$answer->id][option_$loop->iteration]",
                        $answer->media->count() ? $answer->media->first()->url : null,
                        ['class' => 'image-answer-hidden']) !!}
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                    {{ Html::link('#', '', [
                        'class' => 'answer-image-btn fa fa-image upload-choice-image ' . ($answer->media->count() ? 'invisible' : ''), 
                        'data-url' => route('ajax-fetch-image-answer')
                    ]) }}
                    {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-choice-option']) }}
                </div>
                @if ($answer->media->count()) 
                    @include('clients.survey.edit.elements.image-answer', [
                        'imageURL' => $answer->media->first()->url
                    ])
                @endif
            </div>
        @else
            @php
                $existsOtherOption = true;
            @endphp
            <div class="form-row option choice other-choice-option"
                id="answer_{{ $answer->id }}"
                data-answer-id="{{ $answer->id }}"
                data-option-id="{{ $loop->iteration }}">
                <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 choice-input-block">
                    {!! Form::textarea("answer[question_$question->id][answer_$answer->id][option_$loop->iteration]", trans('lang.other_option'), [
                        'class' => 'form-control answer-option-input auto-resize',
                        'readonly' => true,
                    ]) !!}
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                    {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-image invisible']) }}
                    {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-other-choice-option']) }}
                </div>
            </div>
        @endif
    @endforeach
    <div class="form-row other-choice">
        <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
        <div class="other-choice-block">
            <span class="add-choice">@lang('lang.add_option')</span>
            <div class="other-choice-btn {{ $existsOtherOption ? 'hidden' : ''}}">
                <span>@lang('lang.or')</span>
                <span class="add-other-choice">@lang('lang.add_other')</span>
            </div>
        </div>
    </div>
</div>
@include('clients.survey.edit.elements.element-footer')
