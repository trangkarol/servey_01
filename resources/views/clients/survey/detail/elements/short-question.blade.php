<div class="item-answer">
    <div class="magic-box-preview short-answer-preview">
        {!! Form::textarea('', '', ['class' => 'input-answer-other auto-resize answer-text short-answer-text',
            'data-autoresize', 'rows' => 1,
            'placeholder' => trans('lang.your_answer')]) !!}
    </div>
</div>
<div class="notice-max-length">@lang('lang.require_length_short')</div>
