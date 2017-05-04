<div class="step2 package-question wizard-hidden step row wizard-step">
    <div class="title-create row">
        <div class="col-md-9 col-xs-9">
            <h3 class="wizard-header">
                {{ trans('home.choose_question') }}
            </h3>
        </div>
        <div class="col-md-3 col-xs-3">
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
        <div class="row col-md-4 col-md-offset-8 col-xs-offset-1 col-xs-10 parent-option">
            <div class="col-md-2 col-xs-2 col-xs-offset-2 col-md-offset-1 container-option-image">
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
            @include('user.blocks.list-button')
        </div>
    </div>
</div>
