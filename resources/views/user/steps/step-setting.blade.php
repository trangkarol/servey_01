<div class="step3 wizard-hidden step wizard-step current">
    <div class="container-setting">
        <div class="label-title-setting">
            {{ trans('info.enter_info') }}
        </div>
        <div class="content-setting">
            {!! Html::image(config('settings.image_system') . 'setup.png', '', [
                'class' => 'img-setting animated flipInX'
            ]) !!}
            <div class="setting-label">
            {{ trans('survey.required_answer') }}
            </div>
            <div class="setting-option row">
                <div class="col-md-2">
                    <div class="slideThree">
                        {{ Form::checkbox('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.email'), '', [
                            'id' => 'requirement-answer',
                        ]) }}
                        {{ Form::label('requirement-answer', ' ') }}
                    </div>
                </div>
                <div class="setting-requirement col-md-10 row div-hidden">
                    <div class="col-md-2">
                        <div class="type-radio-answer row">
                            <div class="box-radio col-md-1">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.email'), '', [
                                    'id' => 'require-email',
                                    'class' => 'option-choose-answer input-radio',
                                ]) }}
                                {{ Form::label('require-email', ' ', [
                                    'class' => 'label-radio',
                                ]) }}
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="col-md-8">{{ trans('survey.require.email') }}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="type-radio-answer row">
                            <div class="box-radio col-md-1">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.name'), '', [
                                    'id' => 'require-name',
                                    'class' => 'option-choose-answer input-radio',
                                ]) }}
                                {{ Form::label('require-name', ' ', [
                                    'class' => 'label-radio',
                                ]) }}
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="col-md-8">{{ trans('survey.require.name') }}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="type-radio-answer row">
                            <div class="box-radio col-md-1">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.both'), '', [
                                    'id' => 'require-email-name',
                                    'class' => 'option-choose-answer input-radio',
                                ]) }}
                                {{ Form::label('require-email-name', ' ', [
                                    'class' => 'label-radio',
                                ]) }}
                                <div class="check"><div class="inside"></div></div>
                            </div>
                            <div class="col-md-8">{{ trans('survey.require.email_and_name') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="validate-requirement-answer row">
            <div class="col-md-6">
                <div class="alert alert-warning warning-center">
                    {{ trans('survey.validate.choose_option') }}
                </div>
            </div>
        </div>
        <div class="div-option-require div-hidden row">
            <div class="col-md-1"></div>
            <div class="squaredThree col-md-1">
                {{ Form::checkbox('setting[' . config('settings.key.requireOnce') . ']', config('settings.key.requireOnce'), '', [
                    'id' => 'require-oneTime',
                ]) }}
                {{ Form::label('require-oneTime', ' ') }}
            </div>
            <div class="tag-once col-md-5">{{ trans('survey.require_once') }}</div>
        </div>
        <div class="div-option-require div-hidden row">
            <div class="col-md-1"></div>
            <div class="squaredThree col-md-1">
                {{ Form::checkbox('setting[' . config('settings.key.tailMail') . ']', '', '', [
                    'id' => 'require-tail-email',
                ]) }}
                {{ Form::label('require-tail-email', ' ') }}
            </div>
            <div class="tag-once col-md-5">{{ trans('survey.tail_mail') }}</div>
        </div>
        <div class="clear"></div>
        <div class="tail-email div-hidden">
            {{ Form::text('setting[' . config('settings.key.tailMail') . ']', '', [
                'placeholder' => trans('survey.placeholder.example'),
                'class' => 'frm-tailmail',
                'data-role' => 'tagsinput',
            ]) }}
        </div>
        <div class="validate-tailmail div-hidden row">
            <div class="col-md-6">
                <div class="alert alert-warning warning-center content-validate-tailmail">
                </div>
            </div>
        </div>
        <div>
            <div class="setting-label">
                {{ trans('survey.replies_limits') }}
            </div>
            <div class="setting-option row">
                <div class="col-md-2">
                    <div class="slideThree">
                        {{ Form::checkbox('setting[' . config('settings.key.limitAnswer') . ']', '', '', [
                            'id' => 'limit-answer',
                        ]) }}
                        {{ Form::label('limit-answer', ' ') }}
                    </div>
                </div>
                <div class="setting-limit col-md-4 div-hidden">
                    <div class="qty-buttons">
                        {{ Form::button('', [
                            'class' => 'qtyplus',
                        ]) }}
                        {{ Form::text('setting[' . config('settings.key.limitAnswer') . ']', '', [
                            'placeholder' => trans('survey.placeholder.none'),
                            'class' => 'quantity-limit qty form-control',
                        ]) }}
                        {{ Form::button('', [
                            'class' => 'qtyminus',
                        ]) }}
                        <span>{{ trans('survey.click_here') }}!</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="validate-limit-answer row">
            <div class="col-md-6">
                <div class="alert alert-warning warning-center">
                    {{ trans('survey.validate.validate_number') }}
                </div>
            </div>
        </div>
        <div>
            <div class="setting-label">
                {{ trans('survey.hide_result') }}
            </div>
            <div class="setting-option row">
                <div class="col-md-2">
                    <div class="slideThree">
                        {{ Form::checkbox('setting[' . config('settings.key.hideResult') . ']', config('settings.key.hideResult'), '', [
                            'id' => 'hide-answer',
                        ]) }}
                        {{ Form::label('hide-answer', ' ') }}
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="setting-label">
                <a>{{ trans('info.private') }}</a>
                {{ trans('info.this_survey') }}?
            </div>
            <div class="setting-option row">
                <div class="col-md-2">
                    <div class="slideThree">
                        {{ Form::checkbox('feature', config('settings.isPrivate'), '', [
                            'id' => 'feature',
                        ]) }}
                        {{ Form::label('feature', ' ') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
