<div class="popupBackground">
    <div class="popupCenter">
        <div class="popupInfo animated bounceInDown">
            <div class="popup-top">
                {{ trans('temp.share') }}
            </div>
            <div class="share-link-public">
                <p class="tag-component">{{ trans('temp.shareable_link') }} <span class="fa fa-link"></span></p>
                <p class="use-link">{{ trans('temp.use_link') }}</p>
                <p class="link-share"></p>
                <div>
                    {!! Form::button('<i class="fa fa-copy"></i> ' . trans('temp.copy_link'), [
                        'class' => 'btn-copy-link',
                    ]) !!}
                    <div class="share-facebook fb-share-button" data-href="" data-layout="button_count"
                        data-size="small" data-mobile-iframe="true">
                        <a class="fb-xfbml-parse-ignore" target="_blank" href="link">
                            {{ trans('survey.share') }}
                        </a>
                    </div>
                </div>
            </div>
            <p class="tag-component">{{ trans('temp.send_mail') }} <i class="fa fa-envelope-o"></i></p>
            <div class="container-send-mail">
                {!! Form::open(['class' => 'frm-submit-mail']) !!}
                    <div>
                        <div>
                            <div class="popup-input">
                                {!! Form::email('emailUser',
                                    (Auth::guard()->check()) ? Auth::user()->email : '', [
                                    'placeholder' => trans('info.your_email'),
                                    'class' => 'input-email form-control',
                                    auth()->check() ? 'disabled' : null,
                                ]) !!}
                            </div>
                        </div>
                        <div>
                            <div class="popup-input">
                                {!! Form::text('emailsUser', '', [
                                    'placeholder' => trans('info.sender_email'),
                                    'class' => 'frm-mail-user',
                                    'data-role' => 'tagsinput',
                                ]) !!}
                            </div>
                        </div>
                        <div class="validate-send-email animated fadeInDown row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="alert alert-warning warning-login-register">
                                    {{ trans('temp.email_invalid') }}
                                </div>
                            </div>
                        </div>
                        <div class="div-send row">
                            <div class="col-md-6">
                                {!! Form::submit(trans('temp.send'), [
                                    'class' => 'btn-send-mail',
                                ]) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::button(trans('temp.cancel'), [
                                    'class' => 'btn-close-popup',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
