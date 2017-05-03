<div class="col-md-2 col-xs-2 container-option-image">
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
<div class="col-md-2 col-xs-2 container-option-image">
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
<div class="col-md-2 col-xs-2 container-option-image">
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
<div class="col-md-2 col-xs-2 container-option-image">
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
