@include('clients.survey.edit.elements.element-header')
<div class="col-12 checkboxes-block">
    @foreach ($question->answers as $answer)
        <div class="form-row option checkbox checkbox-sortable"
            id="answer_{{ $answer->id }}"
            data-answer-id="{{ $answer->id }}"
            data-option-id="{{ $loop->iteration }}">
            <div class="square-checkbox-icon"><i class="fa fa-square-o"></i></div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 checkbox-input-block">
                {!! Form::text("answer[question_$question->id][answer_$answer->id][option_$loop->iteration]",
                    $answer->content,
                    ['class' => 'form-control']) !!}
                {!! Form::hidden("media[question_$question->id][answer_$answer->id][option_$loop->iteration]",
                    $answer->media->count() ? $answer->media->first()->url : null,
                    ['class' => 'image-answer-hidden']) !!}
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                {{ Html::link('#', '', [
                    'class' => 'answer-image-btn fa fa-image upload-checkbox-image ' . ($answer->media->count() ? 'invisible' : ''), 'data-url' => route('ajax-fetch-image-answer')
                ]) }}
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-checkbox-option hidden']) }}
            </div>
            @if ($answer->media->count()) 
                @include('clients.survey.edit.elements.image-answer', [
                    'imageURL' => $answer->media->first()->url
                ])
            @endif
        </div>
    @endforeach
    <div class="form-row other-checkbox">
        <div class="square-checkbox-icon"><i class="fa fa-square-o"></i></div>
        <div class="other-checkbox-block">
            <span class="add-checkbox">@lang('lang.add_option')</span>
            <div class="other-checkbox-btn">
                <span>@lang('lang.or')</span>
                <span class="add-other-checkbox">@lang('lang.add_other')</span>
            </div>
        </div>
    </div>
</div>
@include('clients.survey.edit.elements.element-footer')
