<div class="clear clear-as{{ $number }}{{ $num_as }}"></div>
<div class="div-content-answer qs-as{{ $number }}{{ $num_as }}" >
    <div class="col-md-1 div-square"></div>
    <div class="col-md-9">
        <div class="div-text-answer">
            {!! Form::text("txt-question[answers][$number][][". config('survey.type_checkbox')."]", '', [
                'placeholder' => trans('home.enter_answer_here'),
                'required' => true,
            ]) !!}
        </div>
    </div>
    <div class="remove-answer col-md-1">
        <a class="glyphicon glyphicon-remove" id-as="{{ $number }}{{ $num_as }}" num="{{ $number }}"></a>
    </div>
</div>
