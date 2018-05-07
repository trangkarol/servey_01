<li class="form-line sort title-description-element"
    id="question_{{ $question->id }}"
    data-question-id="{{ $question->id }}"
    data-question-type="{{ config('settings.question_type.title') }}">
    <div class="form-row draggable-area"></div>
    <div class="form-row title-block">
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-10">
            {!! Form::textarea("title[section_$sectionId][question_$question->id]", $question->title, [
                'placeholder' => trans('lang.title_section_placeholder'),
                'class' => 'form-control input-area auto-resize question-input active',
                'data-autoresize',
                'rows' => 1,
            ]) !!}
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-2 button-group-block">
            <div class="title-survey-btn">
                <a href="#" class="copy-element"><i class="fa fa-clone"></i></a>
                <a href="#" class="remove-element"><i class="fa fa-trash"></i></a>
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
                            <span class="option-menu-selected active">
                                <span></span>
                            </span>
                            <span class="option-menu-content">@lang('lang.description')</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row description-input active">
        <div class="col-12">
            {!! Form::textarea("description[section_$sectionId][question_$question->id]", $question->description, [
                'class' => 'form-control question-description-input active input-area auto-resize',
                'data-autoresize',
                'placeholder' => trans('lang.description_section_placeholder'),
                'rows' => 1
            ]) !!}
        </div>
    </div>
</li>