<tr>
    <td>
        <span class="label label-default">{{ trans('home.new') }}</span>
        <a href="{{ action(($survey->feature)
            ? 'AnswerController@answerPublic'
            : 'AnswerController@answerPrivate', [
                'token' => $survey->token,
        ]) }}">
            {{ $survey->sub_title }}
        </a>
    </td>
    <td>
        {{ Carbon\Carbon::parse()->format(trans('temp.format.date')) }}
    </td>
    <td>
        @if ($survey->user_id)
            {{ Html::image($survey->user->image, '', [
                'class' => 'image-avatar',
            ]) }}
        @else
            {{ Html::image(config('settings.image_user_default'), '', [
                'class' => 'image-avatar',
            ]) }}
        @endif
        {{ str_limit($survey->user_name, config('settings.name_length_default')) }}
    </td>
    <td>
        {!! "<span class='glyphicon glyphicon-remove-sign'></span>" . trans('survey.not_yet') !!}
    </td>
    <td>
        <a href="{{ action(($survey->feature)
            ? 'AnswerController@answerPublic'
            : 'AnswerController@answerPrivate', [
                'token' => $survey->token,
        ]) }}">
            {{ trans('survey.link') }}
        </a>
    </td>
</tr>
