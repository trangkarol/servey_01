@if (!$tempAnswers)
    {!! Form::textarea("answer[$idQuestion][$idAnswer]", '', [
        'class' => 'animated zoomIn form-control input' . $idQuestion,
        'required' => true,
    ]) !!}
@endif
