<div >
    <table class="table-invited table table-hover">
        <thead>
            <tr>
                <th>{{ trans('survey.name') }}</th>
                <th>{{ trans('survey.reciever_date') }}</th>
                <th>{{ trans('survey.sender') }}</th>
                <th>{{ trans('survey.status') }}</th>
                <th>{{ trans('survey.detail') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invites as $key => $invite)
                <tr>
                    <td>
                        {{ ++$key }}.
                        <a href="{{ action(($invite->survey->feature)
                            ? 'AnswerController@answerPublic'
                            : 'AnswerController@answerPrivate', [
                                'token' => $invite->survey->token,
                        ]) }}">
                            {{ $invite->survey->title }}
                        </a>
                    </td>
                    <td>
                        {{ $invite->created_at->format('M d Y') }}
                    </td>
                    <td>
                        {{ ($invite->sender) ? $invite->sender->email : $invite->mail }}
                    </td>
                    <td>
                        {!! ($invite->status) ? "<span class='glyphicon glyphicon-remove-sign'></span>" . trans('survey.not_yet')
                        : "<span class='glyphicon glyphicon-ok-sign'></span>" . trans('survey.answered') !!}
                    </td>
                    <td>
                        <?php $deadline = $invite->survey->deadline; ?>
                        @if (in_array($invite->survey_id, $settings)
                        || ($deadline && !Carbon\Carbon::parse($deadline)->gt(Carbon\Carbon::now()) ))
                            {{ trans('survey.closed') }}
                        @else
                            <a href="{{ action(($invite->survey->feature)
                                ? 'AnswerController@answerPublic'
                                : 'AnswerController@answerPrivate', [
                                    'token' => $invite->survey->token,
                            ]) }}">
                                {{ trans('survey.link') }}
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
