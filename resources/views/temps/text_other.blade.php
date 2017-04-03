@if (!$tempAnswers)
    {!! Form::textarea("answer[$idQuestion][$idAnswer]", '', [
        'class' => 'box-orther js-elasticArea animated zoomIn form-control input' . $idQuestion,
        'required' => true,
    ]) !!}
@endif
