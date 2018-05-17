@extends('clients.survey.elements.master')
@section('element-type', config('settings.question_type.date'))
@section('element-content')
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-7 date-answer-input date-answer-input-format">
        <span class="date-format-question" data-dateformat="@lang('lang.date_answer_format')" locale="{{ Session::get('locale') }}">
            @lang('lang.date_answer')
        </span>
        <span class="date-answer-icon date-answer-icon-cusor"></span>
        <div class="menu-choice-dateformat">
            <ul>
                <li class="date-format" data-dateformat="{{ config('settings.date_format_vn') }}">
                    @lang('lang.date_format_vn')
                </li>
                <li class="date-format" data-dateformat="{{ config('settings.date_format_en') }}">
                    @lang('lang.date_format_en')
                </li>
                <li class="date-format" data-dateformat="{{ config('settings.date_format_jp') }}">
                    @lang('lang.date_format_jp')
                </li>
            </ul>
        </div>
    </div>
@endsection
