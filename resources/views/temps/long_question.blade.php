<div class="title-question row question{{ $number }}" question="{{ $number }}">
    <div class="col-md-8 row">
        <div class="text-question col-md-10">
            {!! Form::text("txt-question[question][$number]", '', [
                'placeholder' => trans('home.enter_question_here'),
                'required' => true,
            ]) !!}
        </div>
        <div class="col-md-2">
            <div class="img-trash">
                <a class="glyphicon glyphicon-picture"></a>
                <a class="glyphicon glyphicon-trash col-md-6" id-question="{{ $number }}"></a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="div-content-answer">
        <div class="col-md-1 text-icon" >
            <span class="glyphicon glyphicon-list-alt"></span>
        </div>
        <div class="col-md-8">
            <div class="text-empty">
                {!! Form::text("txt-question[answers][$number][][" . config('survey.type_long') . "]", '', [
                    'placeholder' => trans('temp.long_text'),
                    'readonly' => true,
                ]) !!}
            </div>
        </div>
    </div>
</div>
