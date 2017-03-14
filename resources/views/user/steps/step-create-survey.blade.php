<div class="step2 wizard-hidden step row wizard-step">
    <div class="title-create row">
        <div class="col-md-9">
            <h3 class="wizard-header">
                {{ trans('home.choose_question') }}
            </h3>
        </div>
        <div class="col-md-3">
            <span>
                {{ Html::image(config('settings.image_path_system') . 'arrow-down1.png', '', [
                    'class' => 'animated bounceInDown'
                ]) }}
            </span>
        </div>
    </div>
    <div class="wizard-hidden create-question-validate row">
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-warning warning-center">
                {{ trans('info.create_invalid') }}
            </div>
        </div>
    </div>
    <ul class="container-add-question">
        <div class="add-question col-md-1">
        </div>
        <div class="hide"></div>
    </ul>
    <div class="row">
        <div class="row col-md-4 col-md-offset-8 parent-option">
            <div class="col-md-2 col-md-offset-1 container-option-image">
                <span class="span-option-1">
                    {{ trans('temp.one_choose') }}
                </span>
                {{ Html::image(config('settings.image_path_system') . 'radio.png', '', [
                    'class' => 'image-type-option',
                    'url' => action('TempController@addTemp', config('temp.radio_question')),
                    'id' => 'radio-button',
                    'typeId' => config('survey.type_radio'),
                ]) }}
            </div>
            <div class="col-md-2 container-option-image">
                <span class="span-option-2">
                    {{ trans('temp.multi_choose') }}
                </span>
                {{ Html::image(config('settings.image_path_system') . 'checkbox.png', '', [
                    'class' => 'image-type-option',
                    'url' => action('TempController@addTemp', config('temp.checkbox_question')),
                    'id' => 'checkbox-button',
                    'typeId' => config('survey.type_checkbox'),
                ]) }}
            </div>
            <div class="col-md-2 container-option-image">
                <span class="span-option-3">
                    {{ trans('temp.text') }}
                </span>
                {{ Html::image(config('settings.image_path_system') . 'text.png', '', [
                    'class' => 'image-type-option',
                    'url' => action('TempController@addTemp', config('temp.text_question')),
                    'id' => 'text-button',
                    'typeId' => config('survey.type_text'),
                ]) }}
            </div>
            <div class="col-md-2 container-option-image">
                <span class="span-option-4">
                    {{ trans('temp.time') }}
                </span>
                {{ Html::image(config('settings.image_path_system') . 'time.png', '', [
                    'class' => 'image-type-option',
                    'url' => action('TempController@addTemp', config('temp.time_question')),
                    'id' => 'time-button',
                    'typeId' => config('survey.type_time'),
                ]) }}
            </div>
            <div class="col-md-2 container-option-image">
                <span class="span-option-5">
                    {{ trans('temp.date') }}
                </span>
                {{ Html::image(config('settings.image_path_system') . 'type-date.png', '', [
                    'class' => 'image-type-option',
                    'url' => action('TempController@addTemp', config('temp.date_question')),
                    'id' => 'date-button',
                    'typeId' => config('survey.type_date'),
                ]) }}
            </div>
        </div>
    </div>
</div>
