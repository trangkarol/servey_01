<div class="title-question row question{{ $number }}" question="{{ $number }}" temp-qs="1" trash="2">
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
    <div class="clear clear-as{{ $number }}0"></div>
    <div class="div-content-answer qs-as{{ $number }}0">
        <div class="col-md-1 div-radius"></div>
        <div class="col-md-9">
            <div class="div-text-answer">
                {!! Form::text("txt-question[answers][$number][][" . config('survey.type_radio') . "]", '', [
                    'placeholder' => trans('home.enter_answer_here'),
                    'required' => true,
                ]) !!}
            </div>
        </div>
        <div class="remove-answer col-md-1">
            <a class="glyphicon glyphicon-remove" id-as="{{ $number }}0" num="{{ $number }}"></a>
        </div>
    </div>
    <div class="clear clear-as{{ $number }}1"></div>
    <div class="div-content-answer qs-as{{ $number }}1">
        <div class="col-md-1 div-radius"></div>
        <div class="col-md-9">
            <div class="div-text-answer">
                {!! Form::text("txt-question[answers][$number][][".config('survey.type_radio')."]", '', [
                    'placeholder' => trans('home.enter_answer_here'),
                    'required' => true,
                ]) !!}
            </div>
        </div>
        <div class="remove-answer col-md-1">
            <a class="glyphicon glyphicon-remove" id-as="{{ $number }}1" num="{{ $number }}"></a>
        </div>
    </div>
    <div class="clear temp-other{{ $number }}"></div>
    <div class="choose-action row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            {!! Form::button(trans('home.add_option'), [
                'class' => 'add-radio',
                'id-as' => $number,
                'typeId' => config('survey.type_radio'),
                'url' => action('User\SurveyController@radioAnswer'),
            ]) !!}
        </div>
        <div class="col-md-4">
            {!! Form::button(trans('home.add_other'), [
                'class' => 'add-radio-other other' . $number,
                'url' => action('User\SurveyController@otherRadio'),
                'typeId' => config('survey.type_other_radio'),
            ]) !!}
        </div>
    </div>
</div>
