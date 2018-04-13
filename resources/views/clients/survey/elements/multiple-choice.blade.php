@extends('clients.survey.elements.master')

@section('element-content')
    <div class="col-12 multiple-choice-block">
        <div class="form-row choice choice-sortable">
            <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 choice-input-block">
                {!! Form::text('name', trans('lang.option_1'), ['class' => 'form-control']) !!}
                {!! Form::hidden('imageAnswer', null, ['class' => 'image-answer-hidden']) !!}
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-image upload-choice-image', 'data-url' => route('ajax-fetch-image-answer')]) }}
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-choice-option hidden']) }}
            </div>
        </div>
        <div class="form-row other-choice">
            <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
            <div class="other-choice-block">
                <span class="add-choice">@lang('lang.add_option')</span>
                <div class="other-choice-btn">
                    <span>@lang('lang.or')</span>
                    <span class="add-other-choice">@lang('lang.add_other')</span>
                </div>
            </div>
        </div>
    </div>
@endsection
