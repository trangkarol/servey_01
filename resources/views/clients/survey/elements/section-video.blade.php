<li class="form-line sort">
    <div class="form-row draggable-area"></div>
    <div class="form-row image-block">
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-11 col-10">
            {!! Form::text('titleVideo', '', ['class' => 'form-control title-video-input active', 'placeholder' => trans('lang.video_title')]) !!}
        </div>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2">
            <div class="btn-clone-image-block">
                <a href="" class="fa fa-clone btn-clone-video-insert"></a>
            </div>
        </div>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-2">
            <div class="btn-delete-image-block">
                <a href="" class="fa fa-trash btn-delete-video-insert"></a>
            </div>
        </div>
    </div>
    <div class="form-row show-image-block">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <img class="img-fluid show-thumbnail-video-section" src="" alt="">
        </div>
    </div>
</li>
