<div class="detail-survey">
    @if ($survey->status == config('survey.status.block'))
        {!! Form::open([
            'class' => 'tab-save-info',
            'action' => [
                'SurveyController@updateSurvey',
                $survey->id,
            ],
            'method' => 'PUT',
        ]) !!}
    @endif
        <div class="row">
            <p class="tag-detail-survey">
                {{ $survey->title }}
            </p>
        </div>
        <div class="row">
            <div class="frm-textarea container-infor">
                {!! Html::image(config('settings.image_system') . 'title1.png', '') !!}
                {!! Form::textarea('title', $survey->title, [
                    'class' => 'js-elasticArea form-control',
                    'id' => 'title',
                    'placeholder' => trans('info.title'),
                    $survey->status == config('survey.status.available') ? 'disabled' : null,
                ]) !!}
            </div>
        </div>
        <div class="row">
            <div class="frm-textarea container-infor dealine-infor">
                {!! Html::image(config('settings.image_system') . 'date.png', '') !!}
                    {!! Form::text('deadline', $survey->deadline
                        ? Carbon\Carbon::parse($survey->deadline)->format(trans('temp.format_with_trans'))
                        : '', [
                            'placeholder' => trans('info.duration'),
                            'id' => 'deadline',
                            'class' => 'frm-deadline datetimepicker form-control',
                            $survey->status == config('survey.status.available') ? 'disabled' : null,
                    ]) !!}
                    {!! Form::label('deadline', trans('info.date_invalid'), [
                        'class' => 'wizard-hidden validate-time error',
                    ]) !!}
            </div>
        </div>
        <div class="row">
            <div class="frm-textarea container-infor">
                {!! Html::image(config('settings.image_system') . 'description.png', '') !!}
                {!! Form::textarea('description', $survey->description, [
                    'class' => 'js-elasticArea form-control',
                    'placeholder' => trans('info.description'),
                    $survey->status == config('survey.status.available') ? 'disabled' : null,
                ]) !!}
            </div>
        </div>
        <div class="note-detail-survey">
            {{ trans('survey.link') }}:
            <a href="{{ action(($survey->feature)
                ? 'AnswerController@answerPublic'
                : 'AnswerController@answerPrivate', [
                    'token' => $survey->token,
            ]) }}">
                {{ action(($survey->feature)
                    ? 'AnswerController@answerPublic'
                    : 'AnswerController@answerPrivate', [
                        'token' => $survey->token,
                ]) }}
            </a>
            (<a class="tag-send-email" data-url="{{ action('SurveyController@inviteUser', [
                    'id' => $survey->id,
                    'type' => config('settings.return.view'),
                ]) }}"
                data-type="{{ $survey->feature }}"
                data-link="{{ action('AnswerController@answerPublic', $survey->token) }}">
                <span class="glyphicon glyphicon-send"></span>
                {{ trans('survey.send') }}
            </a>)
        </div>
        <div class="note-detail-survey">
            {{ trans('survey.date_create') }}:
            {{ $survey->created_at->format(trans('info.datetime_format')) }}
        </div>
        @include('user.blocks.validate')
        <div class="container-btn-detail row">
        @if (!$survey->is_expired)
            @if ($survey->status == config('survey.status.available'))
                <div class="col-md-4">
                    {!! Form::button(trans('survey.duplicate'), [
                        'data-url' => action('SurveyController@duplicate', $survey->id),
                        'data-message-confirm' => trans('temp.duplicate-confirm'),
                        'class' => 'btn-duplicate-survey btn-action',
                    ]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::button(trans('survey.close'), [
                        'data-url' => action('SurveyController@close', $survey->id),
                        'data-message-confirm' => trans('temp.close-confirm'),
                        'class' => 'btn-close-survey btn-action',
                    ]) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::button(trans('survey.delete'),  [
                        'data-url' => action('SurveyController@delete'),
                        'id-survey' => $survey->id,
                        'redirect' => action('SurveyController@listSurveyUser'),
                        'class' => 'btn-remove-survey btn-action',
                    ]) !!}
                </div>
            @else
                <div class="col-md-3">
                    {!! Form::submit(trans('survey.save'),  [
                        'class' => 'btn-save-survey btn-action',
                    ]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::button(trans('survey.duplicate'), [
                        'data-url' => action('SurveyController@duplicate', $survey->id),
                        'data-message-confirm' => trans('temp.duplicate-confirm'),
                        'class' => 'btn-duplicate-survey btn-action',
                    ]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::button(trans('survey.open'), [
                        'data-url' => action('SurveyController@open', $survey->id),
                        'data-message-confirm' => trans('temp.open-confirm'),
                        'class' => 'btn-open-survey btn-action',
                    ]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::button(trans('survey.delete'),  [
                        'data-url' => action('SurveyController@delete'),
                        'id-survey' => $survey->id,
                        'redirect' => action('SurveyController@listSurveyUser'),
                        'class' => 'btn-remove-survey btn-action',
                    ]) !!}
                </div>
            @endif
        @else
            <div class="col-md-3">
                {!! Form::submit(trans('survey.save'),  [
                    'class' => 'btn-save-survey btn-action',
                ]) !!}
            </div>
            <div class="col-md-3">
                {!! Form::button(trans('survey.duplicate'), [
                    'data-url' => action('SurveyController@duplicate', $survey->id),
                    'data-message-confirm' => trans('temp.duplicate-confirm'),
                    'class' => 'btn-duplicate-survey btn-action',
                ]) !!}
            </div>
            <div class="col-md-3">
                {!! Form::button(trans('survey.open'), [
                    'data-url' => action('SurveyController@open', $survey->id),
                    'data-message-confirm' => trans('temp.open-confirm'),
                    'class' => 'btn-open-survey btn-action',
                ]) !!}
            </div>
            <div class="col-md-3">
                {!! Form::button(trans('survey.delete'),  [
                    'data-url' => action('SurveyController@delete'),
                    'id-survey' => $survey->id,
                    'redirect' => action('SurveyController@listSurveyUser'),
                    'class' => 'btn-remove-survey btn-action',
                ]) !!}
            </div>
        @endif
        </div>
    @if ($survey->status == config('survey.status.block'))
        {!! Form::close() !!}
    @endif
</div>
