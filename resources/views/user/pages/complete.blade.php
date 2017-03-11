@extends('user.master')
@section('content')
    <div id="survey_container" class="div-complete survey_container animated slideInDown wizard" novalidate="novalidate">
        <div class="top-wizard-complete">
            <strong class="tag-complete tag-wizard-top">
                {{ trans('info.success') }}
            </strong>
        </div>
        <div id="middle-wizard" class="wizard-branch wizard-wrapper">
            <div class="step row wizard-step">
                <div class="row">
                    <div class="col-md-4 complete-info">
                        <h3>{{ trans('info.thank_you') }}, {{ $name }}</h3>
                        <h4>{{ trans('info.survey_created') }}</h4>
                        <p>{{ trans('home.description_complete') }} {{ $email }}</p>
                        <p>{{ trans('info.link_send') }}</p>
                        <a href="{{ action(($feature)
                            ? 'AnswerController@answerPublic'
                            : 'AnswerController@answerPrivate', $token) }}">
                            {{ action(($feature)
                            ? 'AnswerController@answerPublic'
                            : 'AnswerController@answerPrivate', $token) }}
                        </a>
                    </div>
                    <div class="complete-image col-md-8 animated">
                        {!! Html::image(config('settings.image_system') . 'congra.png', '') !!}
                    </div>
                </div>
                <div class="complete-link-admin">
                    <h4>{{ trans('home.description_link') }}</h4>
                        <p>{{ trans('home.admin_link') }}</p>
                        <a href="{{ action('AnswerController@show', [
                            'token' => $tokenManage,
                            'type' => $feature,
                        ]) }}">
                            {{ action('AnswerController@show', [
                                'token' => $tokenManage,
                                'type' => $feature,
                            ]) }}
                        </a>
                </div>
            </div>
        </div>
        <div class="bot-wizard-complete">
        </div>
    </div>
@endsection
