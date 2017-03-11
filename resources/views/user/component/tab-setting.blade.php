 <div class="detail-survey">
    {!! Form::open(['action' => ['SettingController@update', $survey->id]]) !!}
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
                                (in_array(config('settings.key.requireAnswer'), array_keys($access))) ? ('checked = checked') : '',
                            ]) }}
                            {{ Form::label('requirement-answer', ' ') }}
                        </div>
                    </div>
                    @if (in_array(config('settings.key.requireAnswer'), array_keys($access)))
                        <div class="setting-requirement col-md-10 row">
                            <div class="col-md-2">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.email'), '', [
                                    'id' => 'option-choose-email',
                                    'class' => 'option-choose input-radio',
                                    ($access[config('settings.key.requireAnswer')] == config('settings.require.email'))
                                        ? ('checked = checked')
                                        : '',
                                ]) }}
                                {{ Form::label('option-choose-email', trans('survey.require.email'), [
                                    'class' => 'label-radio',
                                ]) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.name'), '', [
                                    'id' => 'option-choose-name',
                                    'class' => 'option-choose input-radio',
                                    ($access[config('settings.key.requireAnswer')] == config('settings.require.name'))
                                        ? ('checked = checked')
                                        : '',
                                ]) }}
                                {{ Form::label('option-choose-name', trans('survey.require.name'), [
                                    'class' => 'label-radio',
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::radio('setting[' . config('settings.key.requireAnswer') . ']', config('settings.require.both'), '', [
                                    'id' => 'option-choose-both',
                                    'class' => 'option-choose input-radio',
                                    ($access[config('settings.key.requireAnswer')] == config('settings.require.both'))
                                        ? ('checked = checked')
                                        : '',
                                ]) }}
                                {{ Form::label('option-choose-both', trans('survey.require.email_and_name'), [
                                    'class' => 'label-radio',
                                ]) }}
                            </div>
                        </div>
                    @endif
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
                                (in_array(config('settings.key.limitAnswer'), array_keys($access))) ? ('checked = checked') : '',
                            ]) }}
                            {{ Form::label('limit-answer', ' ') }}
                        </div>
                    </div>
                    @if (in_array(config('settings.key.limitAnswer'), array_keys($access)))
                        <div class="setting-limit col-md-4">
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
                    @endif
                </div>
            </div>
            <div>
                <div class="setting-label">
                    {{ trans('survey.hide_result') }}
                </div>
                <div class="setting-option row">
                    <div class="col-md-2">
                        <div class="slideThree">
                            {{ Form::checkbox('setting[' . config('settings.key.hideResult') . ']', '', '', [
                                'id' => 'hidden-answer',
                                (in_array(config('settings.key.hideResult'), array_keys($access)) ? ('checked = checked') : ''),
                            ]) }}
                            {{ Form::label('hidden-answer', ' ') }}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                {!! Form::submit(trans('survey.save'),  [
                    'class' => 'btn-save-survey  btn-action',
                ]) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>
