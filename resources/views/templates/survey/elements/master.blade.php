<li class="form-line sort">
    <div class="form-row draggable-area"></div>
    <div class="form-row answer-block">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-11 col-10">
            {!! Form::textarea('name', '', [
                'class' => 'form-control input-area auto-resize question-input active',
                'data-autoresize',
                'placeholder' => trans('lang.question'),
                'rows' => 1
            ]) !!}
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
                        <span>@lang('lang.multiple_choice')</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="form-row description-input">
        <div class="col-12"></div>
    </div>
    <div class="form-row">
        @yield('element-content')
    </div>
    <div class="form-row question-action-group">
        <div class="question-survey-btn">
            <a href="#" class="copy-element"><i class="fa fa-clone"></i></a>
            <a href="#" class="remove-element"><i class="fa fa-trash"></i></a>
            <p>@lang('lang.required')</p>
            <div class="question-required-checkbox">
                <label>
                    {{ Form::checkbox('') }}
                    <span class="toggle"><span class="ripple"></span></span>
                </label>
            </div>
            <div class="option-menu-group">
                <a href="#" class="fa fa-ellipsis-v option-menu"></a>
                <ul class="option-menu-dropdown">
                    <li class="copy-element">
                        <i class="fa fa-clone"></i>
                        <span class="option-menu-content">@lang('lang.duplicate_item')</span>
                    </li>
                    <li class="remove-element">
                        <i class="fa fa-trash"></i>
                        <span class="option-menu-content">@lang('lang.remove_item')</span>
                    </li>
                    <h5>@lang('lang.show')</h5>
                    <li>
                        <span class="option-menu-selected">
                            <span></span>
                        </span>
                        <span class="option-menu-content">@lang('lang.description')</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
