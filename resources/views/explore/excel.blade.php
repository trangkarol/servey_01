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
                @foreach ($data['questions'] as $question)
                    <th>{!! $question['content'] !!}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if (count($data['results']))
                @foreach ($data['results'] as $results)
                    <tr>
                        <td>{{ $results[0]['created_at'] }}</td>
                        @foreach ($results as $result)
                            @if (in_array($result['answer']['type'], [
                                config('survey.type_radio'),
                                config('survey.type_checkbox'),
                                config('survey.type_other_radio'),
                                config('survey.type_other_checkbox'),
                            ]))
                                <td>{{ cleanTextForExport($result['answer']['content']) }}</td>
                            @elseif ($result['answer']['type'] != config('survey.type_radio')
                                && $result['answer']['type'] != config('survey.type_checkbox'))
                                    <td>{{ cleanTextForExport($result['content']) }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
