<div class="item-answer">
    <span class="description-date-time">@lang('lang.date') :</span>
    <div class="input-group date">
        <input type="text" class="input-answer-other datetimepicker-input date-answer-preview datepicker-preview"
            id="datepicker-preview{{ $question->id }}" data-toggle="datetimepicker"  data-dateformat="{{ strtoupper($question->date_format) }}"
            data-target="#datepicker-preview{{ $question->id }}" placeholder="{{ $question->date_format }}" />
    </div>
</div>
