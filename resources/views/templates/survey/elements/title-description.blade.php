<li class="form-line sort title-description-element">
    <div class="form-row title-block">
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-10">
            {!! Form::textarea('element', '', [
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
                <a href="#"><i class="fa fa-ellipsis-v"></i></a>
            </div>
        </div>
    </div>
    <div class="form-row description-block">
        <div class="col-12">
            {!! Form::text('description', '', [
                'placeholder' => trans('lang.description_section_placeholder'),
                'class' => 'form-control question-description-input active',
            ]) !!}
        </div>
    </div>
</li>
