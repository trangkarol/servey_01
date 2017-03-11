<div class="detail-survey">
    <div class="row">
        <p class="tag-detail-survey">
            {{ $survey->title }}
        </p>
        <div class="col-md-6">
            <ul class="data-list">
                <li>
                    <div class="container-infor">
                        {!! Html::image(config('settings.image_system') . 'title1.png', '') !!}
                        {!! Form::text('title', $survey->title, [
                            'placeholder' => trans('info.title'),
                            'id' => 'title',
                            'class' => 'required form-control',
                        ]) !!}
                    </div>
                </li>
                {!! Form::text('website', '', [
                    'id' => 'website',
                ]) !!}
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="data-list">
                <li>
                    <div class="container-infor">
                        {!! Html::image(config('settings.image_system') . 'date.png', '') !!}
                        {!! Form::text('deadline', '', [
                            'placeholder' =>  ($survey->dealine) ?: trans('info.duration'),
                            'id' => 'deadline',
                            'class' => 'frm-deadline datetimepicker form-control',
                        ]) !!}
                        {!! Form::label('deadline', trans('info.date_invalid'), [
                            'class' => 'wizard-hidden validate-time error',
                        ]) !!}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="frm-textarea container-infor">
            {!! Html::image(config('settings.image_system') . 'description.png', '') !!}
            {!! Form::textarea('description', '', [
                'class' => 'form-control',
                'placeholder' => trans('info.description'),
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
    </div>
    <div class="note-detail-survey">
        {{ trans('survey.date_create') }}:
        {{ $survey->created_at->format('M d Y') }}
    </div>
    <div class="container-btn-detail row">
        <div class="col-md-3 col-md-offset-3">
            {!! Form::submit(trans('survey.save'),  [
                'class' => 'btn-save-survey  btn-action',
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
    </div>
</div>
