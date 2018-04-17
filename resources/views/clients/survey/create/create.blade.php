@extends('clients.layout.master')
@push('styles')
    {!! Html::style(asset(config('settings.plugins') . 'js-offcanvas/js-offcanvas.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'metismenu/metisMenu.min.css')) !!}
    {!! Html::style(asset(config('settings.public_template') . 'css/fontsv2/fonts-v2.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/form-builder-custom.css')) !!}
@endpush
@section('content')
    <div class="background-user-profile"></div>
    <!-- .cd-main-header -->
    <main class="cd-main-content">
        <!-- Content Wrapper  -->
        <div class="content-wrapper">
            {!! Form::open([
                'class' => 'survey-form',
            ]) !!}
                <!-- Scroll buttons -->
                <div class="scroll-button-group-sidebar">
                    <div class="button-group-sidebar">
                        <div class="survey-action">
                            <button type="button" class="btn btn-outline-light text-dark" id="add-question-btn"
                                data-url="{{ route('ajax-fetch-multiple-choice') }}">
                                <i class="fa fa-fw fa-plus-circle text-dark"></i>
                            </button>
                        </div>
                        <div class="survey-action">
                           <button type="button" class="btn btn-outline-light text-dark" id="add-title-description-btn"
                                data-url="{{ route('ajax-fetch-title-description') }}">
                                <i class="fa fa-fw fa-header text-dark"></i>
                            </button>
                        </div>
                        <div class="survey-action">
                            <button type="button" class="btn btn-outline-light text-dark"
                                id="add-image-section-btn" data-url="{{ route('ajax-fetch-image-section') }}">
                                <i class="fa fa-fw fa-picture-o text-dark"></i>
                            </button>
                        </div>
                        <div class="survey-action">
                            <button type="button" class="btn btn-outline-light text-dark"
                                 id="add-video-section-btn" data-url="{{ route('ajax-fetch-video') }}">
                                <i class="fa fa-fw fa-video-camera text-dark"></i>
                            </button>
                        </div>
                        <div class="survey-action">
                            <button type="button" class="btn btn-outline-light text-dark" id="add-section-btn"
                                data-url="{{ route('ajax-fetch-section') }}">
                                <i class="fa fa-fw fa-bars text-dark"></i>
                            </button>
                        </div>
                        <div class="survey-action">
                            <button type="button" class="btn btn-outline-light text-dark" data-toggle="modal" data-target="#setting-survey">
                                <i class="fa fa-fw fa-cog text-dark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Scroll buttons -->
                <ul class="clearfix form-wrapper">
                    <li class="form-line p-0">
                        <div class="form-header form-header-create">
                            <h1>@lang('lang.create_survey')</h1>
                        </div>
                    </li>
                    <li class="form-line">
                        <label>@lang('lang.title')</label>
                        <div class="form-group">
                            {!! Form::textarea('title', '', [
                                'class' => 'form-control input-area auto-resize',
                                'data-autoresize',
                                'placeholder' => trans('lang.title_placeholder'),
                                'rows' => 1
                            ]) !!}
                        </div>
                        <label>@lang('lang.time')</label>
                        <div class="form-group form-row">
                            <div class="col">
                                {!! Form::text('start_time', '', [
                                    'class' => 'form-control datetimepicker-input',
                                    'id' => 'start-time',
                                    'data-toggle' => 'datetimepicker',
                                    'data-target' => '#start-time',
                                    'placeholder' => trans('lang.start_time__placeholder'),
                                ]) !!}
                            </div>
                            <div class="col">
                                {!! Form::text('end_time', '', [
                                    'class' => 'form-control datetimepicker-input',
                                    'id' => 'end-time',
                                    'data-toggle' => 'datetimepicker',
                                    'data-target' => '#end-time',
                                    'placeholder' => trans('lang.end_time__placeholder'),
                                ]) !!}
                            </div>
                        </div>
                        <label>@lang('lang.description')</label>
                        <div class="form-group">
                            {!! Form::textarea('description', '', [
                                'class' => 'form-control auto-resize',
                                'data-autoresize',
                                'placeholder' => trans('lang.description_placeholder'),
                                'rows' => 3
                            ]) !!}
                        </div>
                    </li>
                </ul>
                @include('clients.survey.elements.section')
            {!! Form::close() !!}
        </div>
        <!-- Content Wrapper  -->
    </main>
    <div id="element-clone">
        <div class="form-row choice other-choice-option">
            <div class="radio-choice-icon"><i class="fa fa-circle-thin"></i></div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 choice-input-block">
                {!! Form::text('name', trans('lang.other_option'), [
                    'class' => 'form-control',
                    'readonly' => true,
                ]) !!}
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-image invisible']) }}
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-other-choice-option']) }}
            </div>
        </div>

        <div class="form-row checkbox other-checkbox-option">
            <div class="square-checkbox-icon"><i class="fa fa-square-o"></i></div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 checkbox-input-block">
                {!! Form::text('name', trans('lang.other_option'), [
                    'class' => 'form-control',
                    'readonly' => true,
                ]) !!}
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 answer-image-btn-group">
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-image invisible']) }}
                {{ Html::link('#', '', ['class' => 'answer-image-btn fa fa-times remove-other-checkbox-option']) }}
            </div>
        </div>
    </div>
    @include('clients.survey.elements.insert-image')
    @include('clients.survey.elements.insert-video')

    <!-- pupup setting survey -->

    <!-- The Modal -->
    <div class="modal fade setting-survey" id="setting-survey">
        <div class="modal-dialog">
            <div class="modal-content modal-content-setting-create-survey">
                <div class="modal-header modal-header-setting-survey">
                    <h4 class="modal-title title-setting-survey">@lang('lang.settings')</h4>
                </div>
                <ul class="nav nav-tabs nav-setting-survey" role="tablist">
                    <li class="nav-item nav-item-setting-survey">
                        <a class="nav-link active" data-toggle="tab" href="#general_settings">@lang('lang.general_settings')</a>
                    </li>
                </ul>

              <!-- Tab panes -->
                <div class="tab-content tab-content-setting">
                    <div id="general_settings" class="container tab-pane active"><br>
                        {!! Form::open() !!}
                            <div class="setting-email-create-survey">
                                <div class="item-setting">
                                    <div class="setting-confirm-reply">
                                        <label class="container-checkbox-setting-survey">
                                            <span>@lang('lang.required_infomation')</span>
                                            {!! Form::checkbox('confirm_reply', '', false,
                                                ['class' => 'confirm-reply', 'id' => 'confirm-reply']) !!}
                                            <span class="checkmark-setting-survey"></span>
                                    </div>
                                    <div class="setting-choose-confirm-reply">
                                        <label class="container-radio-setting-survey">@lang('lang.login')
                                            {!! Form::radio('radio_request_login', '', true, ['class' => 'setting-radio-request', 'disabled']) !!}
                                            <span class="checkmark-radio"></span>
                                        </label><br>
                                        <label class="container-radio-setting-survey">@lang('lang.login_by_wsm')
                                            {!! Form::radio('radio_request_login', '', false, ['class' => 'setting-radio-request', 'disabled']) !!}
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="item-setting">
                                    <label class="container-checkbox-setting-survey">
                                        <span>@lang('lang.limit_replies')</span>
                                        {!! Form::checkbox('limit_number_answer', '', false,
                                            ['class' => 'limit-number-answer', 'id' => 'limit-number-answer']) !!}
                                        <span class="checkmark-setting-survey"></span>
                                    </label>
                                    <div class="number-limit-number-answer content-quantity">
                                        <div class="numbers-row">
                                            <div id="btn-minus-quantity" class="dec qtybutton"><i class="fa fa-minus">&nbsp;</i></div>
                                            <input type="number" class="quantity-answer" value="{{ config('settings.quantity_answer.default') }}"
                                                min="{{ config('settings.quantity_answer.min') }}"
                                                max="{{ config('settings.quantity_answer.max') }}" id="quantity-answer" name="quantity-answer">
                                            <div id="btn-plus-quantity" class="inc qtybutton"><i class="fa fa-plus">&nbsp;</i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-setting">
                                    <div class="setting-confirm-reply">
                                        <label class="container-checkbox-setting-survey">
                                            <span>@lang('lang.send_a_reminder_email_periodically')</span>
                                            {!! Form::checkbox('checkbox_mail_remind', '', false,
                                                ['class' => 'checkbox-mail-remind', 'id' => 'checkbox-mail-remind']) !!}
                                            <span class="checkmark-setting-survey"></span>
                                    </div>
                                    <div class="setting-mail-remind">
                                        <label class="container-radio-setting-survey">@lang('lang.by_week')
                                            {!! Form::radio('radio_mail_remind', '', true, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                            <span class="checkmark-radio"></span>
                                        </label><br>
                                        <label class="container-radio-setting-survey">@lang('lang.by_month')
                                            {!! Form::radio('radio_mail_remind', '', false, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                            <span class="checkmark-radio"></span>
                                        </label><br>
                                        <label class="container-radio-setting-survey">@lang('lang.by_quarter')
                                            {!! Form::radio('radio_mail_remind', '', false, ['class' => 'radio-mail-remind', 'disabled']) !!}
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="item-setting">
                                    <label class="container-checkbox-setting-survey">
                                        <span>@lang('lang.private_this_survey')</span>
                                        {!! Form::checkbox('security_survey', '', false, ['class' => 'security_survey']) !!}
                                        <span class="checkmark-setting-survey"></span>
                                    </label>
                                </div>
                                <div class="div-action-setting">
                                    <a href="#" class="btn-action-setting-cancel" data-dismiss="modal">@lang('lang.cancel')</a>
                                    <a href="#" class="btn-action-setting-save">@lang('lang.save')</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Plugins -->
    {!! Html::script(asset(config('settings.plugins') . 'jquery-ui/jquery-ui.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/popper.min.js')) !!}
    {!! Html::script(asset(config('settings.public_template') . 'js/modernizr.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.js')) !!}
    <!-- Custom Script -->
    {!! Html::script(asset(config('settings.plugins') . 'metismenu/metisMenu.min.js')) !!}
    {!! Html::script(asset(config('settings.plugins') . 'jquery-menu-aim/jquery.menu-aim.js')) !!}
    {!! Html::script(elixir(config('settings.public_template') . 'js/builder-custom.js')) !!}
@endpush
