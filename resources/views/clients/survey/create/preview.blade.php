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
        <div class="image-header">
            {!! Html::image(asset(Auth::user()->background)) !!}
        </div>
        <!-- Content Wrapper  -->
        <div class="content-wrapper">
            <!-- /Scroll buttons -->
            {!! Form::open() !!}
                <ul class="clearfix form-wrapper content-margin-top-preview ul-preview">
                    <li class="form-line">
                        <div class="form-group">
                            <h2 class="title-survey-preview">@lang('lang.title_placeholder')</h2>
                        </div>
                        <div class="form-group">
                            <span>@lang('lang.description_placeholder')</span>
                        </div>
                    </li>
                    <li class="form-line content-title-section">
                        <div class="form-group">
                            <h3 class="title-section">@lang('lang.section-title')</h3>
                        </div>
                        <div class="form-group form-group-description-section">
                            <span class="description-section">@lang('lang.description_section_placeholder')</span>
                        </div>
                    </li>
                </ul>
                <div class="content-section-preview">
                    <ul class="clearfix form-wrapper ul-preview">
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="item-answer">
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.option_1')</span>
                                    {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.other_option')</span>
                                    {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                                <div class="magic-box-preview">
                                    {!! Form::text('', '', ['class' => 'input-answer-other']) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="img-preview-question-survey">
                                {!! Html::image('https://cdn.ndtv.com/tech/images/gadgets/pikachu_hi_pokemon.jpg?output-quality=70&output-format=webp') !!}
                            </div>
                            <div class="item-answer">
                                <div class="img-preview-answer-survey img-checkbox-preview">
                                    {!! Html::image('http://thuthuattienich.com/wp-content/uploads/2017/02/hinh-anh-pikalong-binh-luan-facebook-3.jpg', '',
                                        ['class' => 'img-answer']) !!}
                                </div>
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.option_1')</span>
                                    {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <div class="img-preview-answer-survey img-checkbox-preview">
                                    {!! Html::image('http://thuthuattienich.com/wp-content/uploads/2017/02/hinh-anh-pikalong-binh-luan-facebook-3.jpg', '',
                                        ['class' => 'img-answer']) !!}
                                </div>
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.option_1')</span>
                                    {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <label class="container-checkbox-setting-survey">
                                    <span>@lang('lang.other_option')</span>
                                    {!! Form::checkbox('', '', false, ['class' => 'checkbox-answer-preview']) !!}
                                    <span class="checkmark-setting-survey"></span>
                                </label>
                                <div class="magic-box-preview">
                                    {!! Form::text('', '', ['class' => 'input-answer-other']) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="item-answer">
                                <label class="container-radio-setting-survey">@lang('lang.option_1')
                                    {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                    <span class="checkmark-radio"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <label class="container-radio-setting-survey">@lang('lang.other_option') : 
                                    {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                    <span class="checkmark-radio"></span>
                                </label>
                                <div class="magic-box-preview">
                                    {!! Form::text('', '', ['class' => 'input-answer-other']) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="img-preview-question-survey">
                                {!! Html::image('https://cdn.ndtv.com/tech/images/gadgets/pikachu_hi_pokemon.jpg?output-quality=70&output-format=webp') !!}
                            </div>
                            <div class="item-answer">
                                <div class="img-preview-answer-survey img-radio-preview">
                                    {!! Html::image('https://cdn.ndtv.com/tech/images/gadgets/pikachu_hi_pokemon.jpg?output-quality=70&output-format=webp', '',
                                        ['class' => 'img-answer']) !!}
                                </div>
                                <label class="container-radio-setting-survey">@lang('lang.option_1')
                                    {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                    <span class="checkmark-radio"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <div class="img-preview-answer-survey img-radio-preview">
                                    {!! Html::image('https://cdn.ndtv.com/tech/images/gadgets/pikachu_hi_pokemon.jpg?output-quality=70&output-format=webp', '',
                                        ['class' => 'img-answer']) !!}
                                </div>
                                <label class="container-radio-setting-survey">@lang('lang.option_1')
                                    {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                    <span class="checkmark-radio"></span>
                                </label>
                            </div>
                            <div class="item-answer">
                                <label class="container-radio-setting-survey">@lang('lang.other_option') : 
                                    {!! Form::radio('answer', '', false, ['class' => 'radio-answer-preview']) !!}
                                    <span class="checkmark-radio"></span>
                                </label>
                                <div class="magic-box-preview">
                                    {!! Form::text('', '', ['class' => 'input-answer-other']) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="item-answer">
                                <div class="magic-box-preview short-answer-preview">
                                    {!! Form::text('', '', ['class' => 'input-answer-other',
                                    'placeholder' => trans('lang.your_answer')]) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="item-answer">
                                <div class="magic-box-preview long-answer-preview">
                                    {!! Form::textarea('', '', ['class' => 'input-answer-other auto-resize',
                                        'data-autoresize', 'rows' => 1,
                                        'placeholder' => trans('lang.your_answer')]) !!}
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="item-answer">
                                <span class="description-date-time">@lang('lang.date') :</span>
                                <div class="input-group date">
                                    <input type="text" class="input-answer-other datetimepicker-input date-answer-preview"
                                        id="datepicker-preview" data-toggle="datetimepicker" locale="{{ Session::get('locale') }}"
                                        data-target="#datepicker-preview" placeholder="@lang('lang.date_placeholder')" />
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.question')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="item-answer">
                                <span class="description-date-time">@lang('lang.hour') :</span>
                                <div class="input-group date">
                                    <input type="text" class="input-answer-other datetimepicker-input time-answer-preview"
                                        id="timepicker-preview" data-toggle="datetimepicker"
                                        data-target="#timepicker-preview" placeholder="@lang('lang.time_placeholder')" />
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <div class="item-answer">
                                <div class="title-question-preview">
                                    <span>@lang('lang.section-title')</span>
                                </div>
                                <div class="form-group form-group-description-section">
                                    <span class="description-section">@lang('lang.description_section_placeholder')</span>
                                </div>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.title')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="img-preview-question-survey">
                                {!! Html::image('https://cdn.ndtv.com/tech/images/gadgets/pikachu_hi_pokemon.jpg?output-quality=70&output-format=webp') !!}
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            <h4 class="title-question">@lang('lang.title')</h4>
                            <div class="form-group form-group-description-section">
                                <span class="description-section">@lang('lang.description_section_placeholder')</span>
                            </div>
                            <div class="img-preview-question-survey">
                                <iframe height="180" width="320" src="https://www.youtube.com/embed/bnj1xUDkpBk?list=RDbnj1xUDkpBk"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                </iframe>
                            </div>
                        </li>
                        <li class="li-question-review form-line">
                            {!! Form::button(trans('lang.next'), ['class' => 'btn-action-preview']) !!}
                        </li>
                    </ul>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- Content Wrapper  -->
    </main>
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
    {!! Html::script(elixir(config('settings.public_template') . 'js/preview.js')) !!}
@endpush
