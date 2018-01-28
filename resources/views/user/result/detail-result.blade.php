<table class="table-result table table-bordered">
    <thead class="thead-default">
        <tr class="result-header">
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
                {{ trans('survey.answer') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($survey->questions as $question)
            @if ($question->update >= 0)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $question->answers->first()->name_type }}</td>
                    <td><div>{!! $question->content !!}</div></td>
                    <td>
                        <a href="javascript:void(0)" class="show-answer" data-toggle="modal" data-target="#question-{{ $question->id }}">{{ trans('survey.show_answer') }}</a>
                        @include('user.result.detail_answer', ['question' => $question])
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
