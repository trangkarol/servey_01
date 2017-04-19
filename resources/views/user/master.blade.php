<!DOCTYPE html>
<html lang="en" class=" js no-touch csstransforms csstransitions">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>{{ trans('info.fsurvey') }}</title>
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ config('settings.image_path_system') . 'favicon.ico' }}" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('library.css-file')
        @include('library.js-file')
    </head>
    <body>
        <div class="loader">
            <div>
                {!! Html::image(config('settings.image_path_system') . 'load.gif', '') !!}
            </div>
        </div>
        @include('user.blocks.popup-send-mail')
        <div class="append-multi-history">
            <div class="popup-user-answer">
                <div class="popup-content-history popupCenter"></div>
            </div>
        </div>
        {!! Form::hidden('', '', [
            'class' => 'data',
            'data-number' => config('temp.data_number') . Carbon\Carbon::now()->timestamp,
            'data-question' => config('temp.data_question'),
            'data-error' => trans('home.error'),
            'data-confirm' => trans('temp.confirm'),
            'data-email-invalid' => trans('temp.email_invalid'),
            'data-host' => config('app.socket.socket_host'),
            'data-port' => config('app.socket.socket_port'),
            'data-confirm' => trans('temp.confirm'),
            'data-format-date' => trans('temp.format_date'),
            'data-format-datetime' => trans('temp.format_datetime'),
        ]) !!}
        <section id="top-area">
            @include('user.blocks.menu')
            <div class="container animated slideInDown">
                 <div class="row">
                     <div class="col-md-12 main-title">
                        <h1>{{ trans('view.title_web') }}</h1>
                        <p>{{ trans('view.body.intro.slogan') }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="container" id="main">
            @yield('content')
            @yield('content-info-web')
        </section>
        @include('user.blocks.footer')
        <div class="modal fade" id="modal-id" data-id="" data-id-answer="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {!! Form::button('&times;', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-hidden' => 'true']) !!}
                        <h4 class="modal-title">{{ trans('home.media_upload') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="win-img">
                            <div class="photo-tb">
                                <div class="row">
                                    <div class="col col-md-10 photo-tb-url">
                                        <div class="add-link-image-group">
                                            <input class="photo-tb-url-txt form-control" placeholder="{{ trans('home.url_hint') }}" name="urlImageTemp" type="text">
                                            <span class="add-image-by-link label-info btn-green">
                                                {{ trans('home.add') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 photo-tb-ui">
                                        <div class="photo-tb-btn photo-tb-upload">
                                            <span class="fa fa-camera"></span>
                                            <p>{{ trans('home.upload') }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="message">
                                <p class="text-danger text-center modal-message"></p>
                            </div>
                            <div class="photo-preivew">
                                <img src="" class="img-pre-option">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::button(trans('home.close'), ['class' => 'btn btn-danger btn-no', 'data-dismiss' => 'modal']) !!}
                        {!! Form::button(trans('home.save'), ['class' => 'btn btn-info btn-green btn-yes']) !!}
                    </div>
                </div>
            </div>
        </div>
        @section('js-var')
            <script>
                var data = {
                    defaultImg: '{{ asset(config('temp.image_default')) }}',
                    hint: '{{ trans('home.url_hint') }}',
                    msg : {
                        yt : '{{ trans('home.msg.yt') }}',
                        vm : '{{ trans('home.msg.vm') }}',
                        img : '{{ trans('home.msg.img') }}',
                        false : '{{ trans('home.msg.false') }}',
                        timeout : '{{ trans('home.msg.time_out') }}',
                        large: '{{ trans('home.msg.large') }}',
                        notImg: '{{ trans('home.msg.not_img') }}',
                        totalSize: '{{ trans('home.msg.total_err') }}',
                    },
                }
            </script>
        @show
    </body>
</html>
