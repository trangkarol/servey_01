<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <table class="table-result table" border="1">
        <thead class="thead-default">
            <tr>
                <th>
                    {{ trans('lang.timestamps') }}
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
                    @php
                        $result = $result->sortBy('order')->sortBy('section_order');
                    @endphp
                    <tr>
                        <td>{{ $result->first()->created_at }}</td>
                        @if ($data['requiredSurvey'] != config('settings.survey_setting.answer_required.none'))
                            <td>{{ $result->first()->user ? $result->first()->user->email : trans('lang.incognito') }}</td>
                        @endif
                        @foreach ($result->groupBy('question_id') as $answers)
                            @if ($answers->count() == 1)
                                <td>{!! $answers->first()->content_answer !!}</td>
                            @else
                                <td>
                                    @foreach ($answers as $answer)
                                        {!! $answer->content_answer !!}
                                        {{ ($answer == $answers->last()) ? '' : ',' }}
                                    @endforeach
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
