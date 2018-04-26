@extends('clients.survey.elements.master')
@section('element-type', config('settings.question_type.checkboxes'))
@section('element-content')
    <div class="col-12 checkboxes-block">
        <div class="form-row option checkbox checkbox-sortable"
            id="answer_{{ $answerId }}"
            data-answer-id="{{ $answerId }}"
            data-option-id="{{ $optionId }}">
            <div class="square-checkbox-icon"><i class="fa fa-square-o"></i></div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 checkbox-input-block">
                {!! Form::text("answer[question_$questionId][answer_$answerId][option_$optionId]", trans('lang.option_1'), ['class' => 'form-control']) !!}
                {!! Form::hidden("media[question_$questionId][answer_$answerId][option_$optionId]", null, ['class' => 'image-answer-hidden']) !!}
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-image upload-checkbox-image', 'data-url' => route('ajax-fetch-image-answer')]) }}
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-checkbox-option hidden']) }}
            </div>
        </div>
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
@endsection
