<table class="table-list-survey table table-hover table-result-user table-bordered">
        @forelse ($surveyCloses as $survey)
            @if ($loop->first)
                <thead>
                    <tr>
                        <th>{{ trans('survey.name') }}</th>
                        <th>{{ trans('survey.date_create') }}</th>
                        <th>{{ trans('survey.status') }}</th>
                        <th>{{ trans('survey.setting') }}</th>
                    </tr>
                </thead>
                <tbody>
            @endif
            <tr>
                <td>
                    {{ $loop->iteration }}.
                    <a href="{{ action(($survey->feature)
                        ? 'AnswerController@answerPublic'
                        : 'AnswerController@answerPrivate', [
                            'token' => $survey->token,
                    ]) }}">
                    {{ $survey->title }}
                    </a>
                </td>
                <td>
                    {{ Carbon\Carbon::parse($survey->created_at)->format(trans('temp.format.date')) }}
                </td>
                <td class="td-servey-closed">
                    {{ trans('survey.closed') }}
                </td>
                <td class="margin-center">
                    <a href="{{ action('AnswerController@show', [
                        'token' => $survey->token_manage,
                        'type' => $survey->feature,
                    ]) }}" class="glyphicon glyphicon-cog"></a>
                </td>
            </tr>
            @if ($loop->last)
                </tbody>
            @endif
        @empty
            <div class="alert alert-warning">
                {{ trans('messages.not_have_results') }}
            </div>
        @endforelse
    </tbody>
</table>
{!! $surveyCloses->links() !!}
