<div class="item-answer">
    <span class="description-date-time">@lang('lang.date') :</span>
    <div class="input-group date">
        <input type="text" class="datepicker-preview input-answer-other answer-text
            datetimepicker-input date-answer-preview"
            id="datepicker-preview{{ $question->id }}" data-toggle="datetimepicker" locale="{{ Session::get('locale') }}"
            data-target="#datepicker-preview{{ $question->id }}" placeholder="@lang('lang.date_placeholder')" />
    </div>
</div>
