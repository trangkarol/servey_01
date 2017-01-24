<div class="clear clear-as{{ $number }}{{ $num_as }}"></div>
<div class="div-content-answer qs-as{{ $number }}{{ $num_as }}" >
    <div class="col-md-1"></div>
    <div class="col-md-6">
        <div class="div-text-answer">
            {!! Form::text("txt-question[answers][$number][][1]", '',
                    ['placeholder' => trans('home.enter_answer_here'), 'required' => true ]) !!}
        </div>
        <div class="div-radio">
            {!! Form::radio('radio', '', '', ['disabled' => true]); !!}
        </div>
    </div>
    <div class="remove-answer col-md-1">
        <a class="glyphicon glyphicon-remove" id-as="{{ $number }}{{ $num_as }}"></a>
    </div>
</div>
