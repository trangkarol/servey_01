<li class="form-line sort section-show-image-insert" data-question-id="{{ $questionId }}" data-question-type="{{ config('settings.question_type.image') }}">
    <div class="form-row draggable-area"></div>
    <div class="form-row image-block">
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-10">
            {!! Form::text("title[section_$sectionId][question_$questionId]", '', [
                'class' => 'form-control question-input active',
                'placeholder' => trans('lang.image_title')
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
                            <span class="option-menu-selected">
                                <span></span>
                            </span>
                            <span class="option-menu-content">@lang('lang.hover_text')</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row description-input">
        <div class="col-12">
            {!! Form::textarea("description[section_$sectionId][question_$questionId]", '', [
                'class' => 'form-control question-description-input active input-area auto-resize',
                'data-autoresize',
                'placeholder' => trans('lang.description_section_placeholder'),
                'rows' => 1,
            ]) !!}
        </div>
    </div>
    <div class="form-row show-image-block">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <div class="box-show-image">
                {!! Form::hidden("media[section_$sectionId][question_$questionId]", $imageURL, ['class' => 'input-image-section-hidden']) !!}
                <img class="img-fluid show-image-insert-section" src="{{ $imageURL }}" alt="">
                <span class="option-image-section" data-url="{{ route('ajax-remove-image') }}">
                    <i class="fa fa-ellipsis-v"></i>
                    <ul class="option-menu-dropdown option-menu-image">
                        <li class="change-image-section">
                            <i class="fa fa-picture-o text-dark"></i>
                            <span class="option-menu-content">@lang('lang.change_image')</span>
                        </li>
                        <li class="remove-image-section" data-url="{{ route('ajax-remove-image') }}">
                            <i class="fa fa-trash"></i>
                            <span class="option-menu-content">@lang('lang.delete_image')</span>
                        </li>
                    </ul>
                </span>
            </div>
        </div>
    </div>
</li>
