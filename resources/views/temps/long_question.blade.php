<div class="title-question row question{{ $number }}" question="{{ $number }}">
    <div class="col-md-1"></div>
    <div class="col-md-8 row">
        <div class="text-question col-md-10">
            {!! Form::text("txt-question[question][$number]", '',
                ['placeholder' => trans('home.enter_question_here'), 'required' => true])
            !!}
        </div>
        <div class="col-md-2 row">
            <div class="col-md-1">
                <a class="glyphicon glyphicon-picture"></a>
            </div>
            <div class="col-md-1">
                <a class="glyphicon glyphicon-trash col-md-6" id-question="{{ $number }}"></a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="div-content-answer">
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <div class="text-empty">
                {!! Form::textarea("txt-question[answers][$number][][4]", '',
                    ['placeholder' => trans('home.enter_answer_here'), 'readonly' => true]) !!}
            </div>
        </div>
    </div>
</div>
