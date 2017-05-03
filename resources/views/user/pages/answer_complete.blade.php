@extends('user.master')
@section('content')
    <div id="survey_container" class="div-complete survey_container animated slideInDown wizard" novalidate="novalidate">
        <div class="top-wizard-complete">
            <strong class="tag-complete tag-wizard-top">
                {{ trans('messages.answer_complete') }}
            </strong>
        </div>
        <div id="middle-wizard" class="wizard-branch wizard-wrapper">
            <div class="step row wizard-step">
                <div class="row">
                    <h3>
                        {{ trans('messages.answer_is_complete', [
                            'survey' => $survey,
                            'name' => $name ?: '',
                        ]) }}
                    </h3>
                    <div class="complete-image col-md-8 animated">
                    </div>
                </div>
            </div>
        </div>
        <div class="bot-wizard-complete"></div>
    </div>
@endsection
