<div class="container-list-answer1">
    <div class="show-history-answer div-show-result wizard-branch wizard-wrapper">
        <div class="get-title-survey">
            {{ $survey->title }}
        </div>
        <div class="description-survey">
            <h4>
                {{ $survey->description }}
            </h4>
        </div>
        <div class="row">
            @php
                $maxUpdateQuestion = $survey->questions->max('update');
            @endphp
            @foreach ($survey->questions as $key => $question)
                <div>
                    <h4 class="tag-question">
                        {{ ($key + 1) . '. ' . $question->content }}
                        <span>{{ ($question->required) ? '(*)' : '' }}</span>
                    </h4>
                    @if (in_array($question->update, [
                        config('survey.update.change'),
                        config('survey.update.delete'),
                    ]))
                        <div class="isUpdate">
                            @if ($question->update == config('survey.update.delete'))
                                <p class="glyphicon glyphicon-floppy-remove"></p>
                            @else
                                <p class="glyphicon glyphicon-pencil"></p>
                            @endif
                        </div>
                    @elseif ($question->update && $question->update == $maxUpdateQuestion || $question->answers->max('update'))
                        <div class="isUpdate"><p class="glyphicon glyphicon-pencil"></p></div>
                    @endif
                    @if ($question->image)
                        {!! Html::image($question->image, '', [
                            'class' => 'show-img-answer',
                        ]) !!}
                    @endif
                    <ul class="data-list">
                        @foreach ($question->answers as $temp => $answer)
                            <li class="{{ ($question->required) ?  'required' : '' }}">
                                @switch($answer->type)
                                    @case(config('survey.type_radio'))
                                        <div class="type-radio-answer row">
                                            <div class="box-radio col-md-1">
                                                {{ Form::radio("answer[$question->id]", $answer->id, '', [
                                                    'id' => "$key$temp",
                                                    'class' => 'option-choose input-radio',
                                                    'disabled',
                                                    (in_array($answer->id, array_keys($history))) ? 'checked' : null,
                                                ]) }}
                                                {{ Form::label($key.$temp, ' ', [
                                                    'class' => 'label-radio',
                                                ]) }}
                                                <div class="check"><div class="inside"></div></div>
                                            </div>
                                            <div class="col-md-11">{{ $answer->content }}</div>
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_checkbox'))
                                        <div class="type-checkbox-answer row">
                                            <div class="checkbox-answer col-md-1">
                                                {{ Form::checkbox("answer[$question->id][$answer->id]", $answer->id, '', [
                                                    'id' => "$key$temp",
                                                    'class' => 'input-checkbox',
                                                    (in_array($answer->id, array_keys($history))) ? 'checked' : null,
                                                    'disabled',
                                                ]) }}
                                                {{ Form::label($key.$temp, ' ', [
                                                    'class' => 'label-checkbox'
                                                ]) }}
                                            </div>
                                            <div class="col-md-11">{{ $answer->content }}</div>
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_text'))
                                        <div class="show-user-answer">
                                            {{ (in_array($answer->id, array_keys($history)) && $history[$answer->id])
                                                ? trans('result.your_answer') . ' ' . $history[$answer->id]
                                                : trans('result.not_answer')
                                            }}
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_time'))
                                        <div class="show-user-answer">
                                            {{ (in_array($answer->id, array_keys($history)) && $history[$answer->id])
                                                ? trans('result.your_answer') . ' ' . $history[$answer->id]
                                                : trans('result.not_answer')
                                            }}
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_date'))
                                        <div class="show-user-answer">
                                            {{ (in_array($answer->id, array_keys($history)) && $history[$answer->id])
                                                ? trans('result.your_answer') . ' ' . $history[$answer->id]
                                                : trans('result.not_answer')
                                            }}
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_other_radio'))
                                        <div class="type-radio-answer row">
                                            <div class="box-radio col-md-1">
                                                {{ Form::radio("answer[$question->id]", $answer->id, '', [
                                                    'id' => "$key$temp",
                                                    'class' => 'input-radio option-add',
                                                    (in_array($answer->id, array_keys($history))) ? 'checked' : null,
                                                ]) }}
                                                {{ Form::label($key . $temp, ' ', [
                                                    'class' => 'label-radio',
                                                ]) }}
                                                <div class="check"><div class="inside"></div></div>
                                            </div>
                                            <div class="col-md-11">
                                                {{ (in_array($answer->id, array_keys($history)))
                                                    ? ( trans('result.other_opinion') . ' : ' . $history[$answer->id] )
                                                    : trans('result.other_opinion') }}
                                            </div>
                                        </div>
                                    @breakswitch
                                    @case(config('survey.type_other_checkbox'))
                                        <div class="type-checkbox-answer row">
                                            <div class="checkbox-answer col-md-1">
                                                {{ Form::checkbox("answer[$question->id][$answer->id]", $answer->id, '', [
                                                    'id' => "$key$temp",
                                                    'class' => 'input-checkbox',
                                                    (in_array($answer->id, array_keys($history))) ? 'checked' : null,
                                                    'disabled',
                                                ]) }}
                                                {{ Form::label($key.$temp, ' ', [
                                                    'class' => 'label-checkbox'
                                                ]) }}
                                            </div>
                                            <div class="col-md-11">
                                                {{ (in_array($answer->id, array_keys($history)))
                                                    ? (trans('result.other_opinion') . ' : ' . $history[$answer->id])
                                                    : trans('result.other_opinion') }}
                                            </div>
                                        </div>
                                    @breakswitch
                                @endswitch
                            </li>
                            @if ($answer->image)
                                <li>
                                    {!! Html::image($answer->image, '', [
                                        'class' => 'show-img-answer',
                                    ]) !!}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

