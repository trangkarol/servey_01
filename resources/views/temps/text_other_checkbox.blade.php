<div class="clear temp-other{{ $number }}"></div>
<div class="temp div-content-answer answer-other{{ $number }} row">
    <div class="col-md-1 div-square"></div>
    <div class="col-md-10">
        <div class="container-text-other div-text-answer">
            {!! Form::text("txt-question[answers][$number][][" . config('survey.type_other_checkbox') . "]", '', [
                'readonly' => 'true',
                'placeholder' => trans('home.other'),
            ]) !!}
        </div>
    </div>
    <div class="remove-answer col-md-1">
        <a class="glyphicon glyphicon-remove remove-other" id-qs="{{ $number }}" num="{{ $number }}"></a>
    </div>
</div>
