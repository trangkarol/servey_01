<div class="divider"></div>
<div class="row">
    <div class="col-md-12 middle-first">
        <h2>{{ trans('view.body.intro.thank_your_time') }}
            <span>{{ trans('view.body.intro.content_thank_your_time') }}</span>
            <span>{{ trans('view.body.intro.content_thank_your_time2') }}</span>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4 add_bottom_30 box">
        <p>{!! Html::image(config('settings.image_path_system') . 'icon-1.png', '') !!}</p>
        <h3>{{ trans('view.body.intro.fully_responsive') }}</h3>
        <p>
            {{ trans('view.body.intro.content_fully_responsive') }}
        </p>
    </div>
    <div class="col-md-4 col-sm-4 add_bottom_30 box">
        <p>{!! Html::image(config('settings.image_path_system') . 'icon-2.png', '') !!}</p>
        <h3>{{ trans('view.body.intro.userful_survey_data') }}</h3>
        <p>{{ trans('view.body.intro.content_userful_survey_data') }}</p>
    </div>
    <div class="col-md-4 col-sm-4 add_bottom_30 box">
        <p>{!! Html::image(config('settings.image_path_system') . 'icon-3.png', '') !!}</p>
        <h3>{{ trans('view.body.intro.receive_by_email') }}</h3>
        <p>{{ trans('view.body.intro.content_receive_by_email') }}</p>
    </div>
</div>
<div class="divider"></div>
<div class="row">
    <div class="col-md-12 middle-last">
        <h3>{{ trans('view.body.intro.some_devices') }}
            <span>{{ trans('view.body.intro.content_some_devices') }}</span>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div id="owl-demo">
            <div class="item">
                <a href="" class="fancybox">
                    <p>{!! Html::image(config('settings.image_path_system') . '1.jpg', '') !!}</p>
                </a>
            </div>
            <div class="item">
                <a href="" class="fancybox">
                    <p>{!! Html::image(config('settings.image_path_system') . '2.jpg', '') !!}</p>
                </a>
            </div>
            <div class="item">
                <a href="" class="fancybox">
                    <p>{!! Html::image(config('settings.image_path_system') . '3.jpg', '') !!}</p>
                </a>
            </div>
            <div class="item">
                <a href="" class="fancybox" >
                    <p>{!! Html::image(config('settings.image_path_system') . '4.jpg', '') !!}</p>
                </a>
            </div>
            <div class="item">
                <a href="" class="fancybox" >
                    <p>{!! Html::image(config('settings.image_path_system') . '5.jpg', '') !!}</p>
                </a>
            </div>
        </div>
    </div>
</div>
