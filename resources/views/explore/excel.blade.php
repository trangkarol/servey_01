<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table class="table-result table">
        <thead class="thead-default">
            <tr>
                <th>
                    {{ trans('survey.index') }}
                </th>
                <th>
                    {{ trans('survey.question_type') }}
                </th>
                <th>
                    {{ trans('survey.question') }}
                </th>
                <th>
                    {{ trans('survey.answerIndex') }}
                </th>
                <th>
                    {{ trans('survey.answer') }}
                </th>
                <th>
                    {{ trans('survey.quantity') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($survey->questions as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                    @switch($value->answers[0]->type)
                        @case(config('survey.type_radio'))
                            {{ trans('temp.one_choose') }}
                            @breakswitch
                        @case(config('survey.type_checkbox'))
                            {{ trans('temp.multi_choose') }}
                            @breakswitch
                        @case(config('survey.type_text'))
                            {{ trans('temp.text') }}
                            @breakswitch
                        @case(config('survey.type_date'))
                            {{ trans('temp.date') }}
                            @breakswitch
                        @case(config('survey.type_time'))
                            {{ trans('temp.time') }}
                            @breakswitch
                    @endswitch
                    </td>
                    <td>{{ $value->content }}</td>
                    <td>{{ '' }}</td>
                    <td>{{ '' }}</td>
                    <td>{{ '' }}</td>
                    <td>{{ '' }}</td>
                </tr>
                @foreach ($value->answers as $keyAnswer => $answer)
                    @if (in_array($answer->type, [
                        config('survey.type_radio'),
                        config('survey.type_checkbox'),
                        config('survey.type_other_radio'),
                        config('survey.type_other_checkbox'),
                    ]))
                        <tr>
                            <td>{{ '' }}</td>
                            <td>{{ '' }}</td>
                            <td>{{ '' }}</td>
                            <td>{{ $key . '.' . ++$keyAnswer }}</td>
                            <td>{{ $answer->content }}</td>
                            <td>{{ count($answer->results) }}</td>
                        </tr>
                    @elseif ($answer->type != config('survey.type_radio')
                        && $answer->type != config('survey.type_checkbox'))
                        @foreach ($answer->results as $result)
                            <tr>
                                <td>{{ '' }}</td>
                                <td>{{ '' }}</td>
                                <td>{{ '' }}</td>
                                <td> - </td>
                                <td>{{ $result->content }}</td>
                                <td>{{ '' }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
