@extends('user.master')
@section('content')
    <div id="survey_container" class="div-complete survey_container animated slideInDown wizard" novalidate="novalidate">
        <div class="top-wizard-complete">
            <strong class="tag-complete tag-wizard-top">
                {{ trans('info.success') }}
            </strong>
            <div class="shadow"></div>
        </div>
        <div id="middle-wizard" class="wizard-branch wizard-wrapper">
            <div class="step row wizard-step">
                <div class="row">
                    <div class="col-md-4 complete-info">
                        <h3>{{ trans('info.thank_you') }}, {{ $survey->user_name }}</h3>
                        <h4>{{ trans('info.survey_created') }}</h4>
                        <p>{{ trans('home.description_complete') }} {{ $mail }}</p>
                        <p>{{ trans('info.link_send') }}</p>
                        <a class="tag-link-answer" href="{{ action(($survey->feature)
                            ? 'AnswerController@answerPublic'
                            : 'AnswerController@answerPrivate', $survey->token) }}">
                            {{ action(($survey->feature)
                            ? 'AnswerController@answerPublic'
                            : 'AnswerController@answerPrivate', $survey->token) }}
                        </a>
                        <div class="copy-share-fb">
                            @if ($survey->feature)
                                {!! Form::button('<i class="fa fa-copy"></i> ' . trans('temp.copy_link'), [
                                    'class' => 'btn-copy-link-complete',
                                ]) !!}
                                <div class="fb-share-button" data-href="{{ action( 'AnswerController@answerPublic', $survey->token) }}"
                                    data-layout="button_count" data-size="small" data-mobile-iframe="true">
                                    <a class="fb-xfbml-parse-ignore" target="_blank" href="link">
                                        {{ trans('survey.share') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                        <hr>
                        <h4>{{ trans('home.description_link') }}</h4>
                        <p>{{ trans('home.admin_link') }}</p>
                    </div>
                    <div class="complete-image col-md-8 animated">
                        {!! Html::image(config('settings.image_system') . 'congra.png', '') !!}
                    </div>
                </div>
                <a href="{{ action('AnswerController@show', [
                    'token' => $survey->token_manage,
                ]) }}" class="tag-link-manage">
                    {{ action('AnswerController@show', [
                        'token' => $survey->token_manage,
                    ]) }}
                </a>
            </div>
        </div>
        <div class="bot-wizard-complete">
            <div class="shadow-bottom"></div>
        </div>
    </div>
@endsection
