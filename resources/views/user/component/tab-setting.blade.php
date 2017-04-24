 <div class="detail-survey">
    {!! Form::open(['action' => ['SettingController@update',
        'id' => $survey->id,
        'token' => $survey->token_manage,
    ]]) !!}
        <div class="container-setting">
            <div class="label-title-setting">
                {{ trans('survey.setting_survey') }}
            </div>
            <div class="content-setting">
                <div class="setting-label">
                    {{ trans('survey.required_answer') }}
                </div>
                <div class="setting-option row">
                    <div class="col-md-2">
                        <div class="slideThree">
                            {{ Form::checkbox('setting[' . config('settings.key.requireAnswer') . ']', '', '', [
                                'id' => 'requirement-answer',
                                ($access[config('settings.key.requireAnswer')]) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('requirement-answer', ' ') }}
                        </div>
                    </div>
                    <div class="setting-requirement col-md-10 row {{ $access[config('settings.key.requireAnswer')] ? '' : 'div-hidden' }}">
                        <div class="col-md-2">
                            <div class="type-radio-answer row">
                                <div class="box-radio col-md-1">
                                    {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.email'), '', [
                                        'id' => 'option-choose-email',
                                        'class' => 'option-choose-answer input-radio',
                                        ($access[config('settings.key.requireAnswer')] == config('settings.require.email')) ? ('checked=checked') : '',
                                    ]) }}
                                    {{ Form::label('option-choose-email', ' ', [
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
                                        'id' => 'option-choose-name',
                                        'class' => 'option-choose-answer input-radio',
                                        ($access[config('settings.key.requireAnswer')] == config('settings.require.name')) ? ('checked=checked') : '',
                                    ]) }}
                                    {{ Form::label('option-choose-name', ' ', [
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
                                        'id' => 'option-choose-both',
                                        'class' => 'option-choose-answer input-radio',
                                        ($access[config('settings.key.requireAnswer')] == config('settings.require.both')) ? ('checked=checked') : '',
                                    ]) }}
                                    {{ Form::label('option-choose-both', ' ', [
                                        'class' => 'label-radio',
                                    ]) }}
                                    <div class="check"><div class="inside"></div></div>
                                </div>
                                <div class="col-md-8">{{ trans('survey.require.email_and_name') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="validate-requirement-answer row">
                        <div class="col-md-6">
                            <div class="alert alert-warning warning-center">
                                {{ trans('survey.validate.choose_option') }}
                            </div>
                        </div>
                    </div>
                    <div class="div-option-require row
                        {{ in_array($access[config('settings.key.requireAnswer')], [
                            config('settings.require.email'),
                            config('settings.require.both'),
                        ]) ? '' : 'div-hidden' }}">
                        <div class="col-md-1"></div>
                        <div class="squaredThree col-md-1">
                            {{ Form::checkbox('setting[' . config('settings.key.requireOnce') . ']', config('settings.key.requireOnce'), '', [
                                'id' => 'require-oneTime',
                                ($access[config('settings.key.requireOnce')] == config('settings.key.requireOnce')) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('require-oneTime', ' ') }}
                        </div>
                        <div class="tag-once col-md-5">{{ trans('survey.require_once') }}</div>
                    </div>
                    <div class="div-option-require row
                        {{ in_array($access[config('settings.key.requireAnswer')], [
                            config('settings.require.email'),
                            config('settings.require.both'),
                        ]) ? '' : 'div-hidden' }}">
                        <div class="col-md-1"></div>
                        <div class="squaredThree col-md-1">
                            {{ Form::checkbox('setting[' . config('settings.key.tailMail') . ']', '', '', [
                                'id' => 'require-tail-email',
                                ($access[config('settings.key.tailMail')]) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('require-tail-email', ' ') }}
                        </div>
                        <div class="tag-once col-md-5">{{ trans('survey.tail_mail') }}</div>
                    </div>
                    <div class="clear"></div>
                    <div class="tail-email {{ ($access[config('settings.key.tailMail')]) ? '' : 'div-hidden' }}">
                        {{ Form::text('setting[' . config('settings.key.tailMail') . ']', $access[config('settings.key.tailMail')], [
                            'placeholder' => trans('survey.placeholder.example'),
                            'class' => 'frm-tailmail',
                            'data-role' => 'tagsinput',
                        ]) }}
                    </div>
                    <div class="validate-tailmail div-hidden row">
                        <div class="col-md-6">
                            <div class="alert alert-warning warning-center content-validate-tailmail">
                                {{ trans('survey.validate.tailmail') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-tab-setting">
                {!! Html::image(config('settings.image_system') . 'setup3.png', '',[
                    'class' => 'animated flipInX'
                ]) !!}
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
                                ($access[config('settings.key.limitAnswer')]) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('limit-answer', ' ') }}
                        </div>
                    </div>
                    <div class="setting-limit col-md-4 {{ ($access[config('settings.key.limitAnswer')]) ? '' : 'div-hidden' }}">
                        <div class="qty-buttons">
                            {{ Form::button('', [
                                'class' => 'qtyplus',
                            ]) }}
                            {!! Form::text('setting[' . config('settings.key.limitAnswer') . ']', $access[config('settings.key.limitAnswer')], [
                                'class' => 'quantity-limit qty form-control required',
                                'placeholder' => trans('survey.require.none'),
                            ]) !!}
                            {{ Form::button('', [
                                'class' => 'qtyminus',
                            ]) }}
                            <span>{{ trans('survey.click_here') }}!</span>
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
            </div>
            <div>
                <div class="setting-label">{{ trans('survey.hide_result') }}</div>
                <div class="setting-option row">
                    <div class="col-md-2">
                        <div class="slideThree">
                            {{ Form::checkbox('setting[' . config('settings.key.hideResult') . ']',  config('settings.key.hideResult'), '', [
                                'id' => 'hidden-answer',
                                ($access[config('settings.key.hideResult')]) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('hidden-answer', ' ') }}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="setting-label">
                    <a>{{ trans('info.public') }}</a>
                    {{ trans('info.this_survey') }}?
                </div>
                <div class="setting-option row">
                    <div class="col-md-2">
                        <div class="slideThree">
                            {{ Form::checkbox('feature', config('settings.feature'), '', [
                                'id' => 'feature',
                                ($survey->feature) ? ('checked=checked') : '',
                            ]) }}
                            {{ Form::label('feature', ' ') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="setting-save row">
                <div class="col-md-4 col-md-offset-4">
                    {!! Form::submit(trans('survey.save'), [
                        'class' => 'btn-save-setting  btn-action',
                    ]) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
