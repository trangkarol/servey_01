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
                    {{ trans('survey.timestamps') }}
                </th>
                @if ($data['requiredSurvey'] != config('settings.survey_setting.answer_required.none'))
                    <th>{{ trans('lang.email') }}</th>
                @endif
                @foreach ($data['questions'] as $question)
                    @if (!in_array($question->type, [
                        config('settings.question_type.title'),
                        config('settings.question_type.image'),
                        config('settings.question_type.video'),
                    ]))
                        <th>{!! $question['title'] !!}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if (count($data['results']))
                @foreach ($data['results'] as $result)
                    <tr>
                        <td>{{ $result->first()->created_at }}</td>
                        @if ($data['requiredSurvey'] != config('settings.survey_setting.answer_required.none'))
                            <td>{{ $result->first()->user->email }}</td>
                        @endif
                        @foreach ($result as $answer)
                            <td>{!! $answer->content_answer !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
