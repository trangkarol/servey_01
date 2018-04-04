<li class="form-line sort">
    <div class="form-row answer-block">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-11 col-10">
            {!! Form::text('name', '', ['class' => 'form-control question-input active', 'placeholder' => trans('lang.question')]) !!}
        </div>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2 question-image-block">
            {{ Html::link('#', '', ['class' => 'question-image-btn fa fa-image']) }}
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-8 question-dropdown-block">
            <div class="survey-select">
                <div class="survey-select-styled">
                    <span>@lang('lang.short_answer')</span>
                </div>
                <ul class="survey-select-options">
                    <li>
                        <span>@lang('lang.short_answer')</span>
                    </li>
                    <li>
                        <span>@lang('lang.paragraph')</span>
                    </li>
                    <li>
                        <span>@lang('lang.short_answer')</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="form-row">
        @yield('element-content')
    </div>

    <div class="form-row question-action-group">
        <div class="question-survey-btn">
            {{ Html::link('#', '', ['class' => 'fa fa-clone copy-element']) }}
            {{ Html::link('#', '', ['class' => 'fa fa-trash remove-element']) }}
            <p>@lang('lang.required')</p>
            <div class="question-required-checkbox">
                <label>
                    {{ Form::checkbox('') }}
                    <span class="toggle"><span class="ripple"></span></span>
                </label>
            </div>
        </div>
    </div>
</li>
