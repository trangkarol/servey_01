<div class="step3 wizard-hidden step wizard-step current">
    <div class="container-setting">
        <div class="label-title-setting">
            {{ trans('info.enter_info') }}
        </div>
        <div class="content-setting">
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
                        {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.email'), '', [
                            'id' => 'require-email',
                            'class' => 'option-choose-answer input-radio',
                        ]) }}
                        {{ Form::label('require-email', trans('survey.require.email'), [
                            'class' => 'label-radio',
                        ]) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.name'), '', [
                            'id' => 'require-name',
                            'class' => 'option-choose-answer input-radio',
                        ]) }}
                        {{ Form::label('require-name', trans('survey.require.name'), [
                            'class' => 'label-radio',
                        ]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.both'), '', [
                            'id' => 'require-email-name',
                            'class' => 'option-choose-answer input-radio',
                        ]) }}
                        {{ Form::label('require-email-name', trans('survey.require.email_and_name'), [
                            'class' => 'label-radio',
                        ]) }}
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
                            'placeholder' => 'none',
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
                        {{ Form::checkbox('settings[' . config('settings.key.hideResult') . ']', '', '', [
                            'id' => 'hide-answer',
                        ]) }}
                        {{ Form::label('hide-answer', ' ') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
