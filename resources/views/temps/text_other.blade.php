@if (!$tempAnswers)
    {!! Form::textarea("answer[$idQuestion][$idAnswer]", '', [
        'class' => 'box-orther required js-elasticArea animated zoomIn form-control input' . $idQuestion,
        'required' => true,
        'placeholder' => trans('home.answer_here'),
    ]) !!}
    {!! Form::label("answer[$idQuestion][$idAnswer]", trans('validation.msg.required'), [
        'class' => 'error div-hidden',
    ]) !!}
@endif
