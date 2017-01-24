<div class="clear temp-other{{ $number }}"></div>
<div class="div-content-answer answer-other{{ $number }}">
    <div class="col-md-1"></div>
    <div class="col-md-6">
        <div class="div-text-answer">
            {!! Form::text("txt-question[answers][$number][][6]", '', ['readonly' => 'true', 'required' => true ]) !!}
        </div>
        <div class="other div-radio">
            {!! Form::checkbox('', '', '', ['disabled' => 'true']) !!}
            <span>{{ trans('home.other') }}</span>
        </div>
    </div>
    <div class="remove-answer col-md-1">
        <a class="glyphicon glyphicon-remove remove-other" id-qs="{{ $number }}"></a>
    </div>
</div>
