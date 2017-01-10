<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ trans('login.get_survey') }}!</title>
        {!! Html::style(elixir('/css/app.css')) !!}
        {!! Html::style(elixir('/user/css/site.css')) !!}
    </head>
    <body class="body-login">
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1> {{ trans('login.satisfaction_survey') }}</h1>
                            <div class="description">
                                <p>{{ trans('login.help_us') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 div-login">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>{{ trans('login.login_our') }}</h3>
                                        <p>{{ trans('login.enter_username') }}</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    {!! Form::open() !!}
                                        <div class="form-group">
                                            {!! Form::email('email', '', ['class' => 'form-username form-control', 'placeholder' => trans('login.email')]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::password('password', ['class' => 'form-password form-control', 'placeholder' => trans('login.password')]) !!}
                                        </div>
                                        <div class="row button-option">
                                            <div class="col-sm-4">
                                                {!! Form::button(trans('login.register'), ['class' => 'btn']) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                {!! Form::button(trans('login.sign_in'), ['type' => 'submit', 'class' => 'btn']) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                {{ Form::button(
                                                    '<i class="fa fa-google-plus"></i> ' . trans('login.google_plus'), ['type' => 'submit', 'class' => 'btn']) }}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 row div-register">
                            <div class="form-box col-sm-offset-1 col-sm-11">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>{{ trans('login.sign_up_now') }}</h3>
                                        <p>{{ trans('login.fill_in_form') }}</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    {!! Form::open() !!}
                                        <div class="form-group">
                                            {!! Form::text('first-name', '',
                                                ['class' => 'form-last-name form-control', 'placeholder' => trans('login.first_name')]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::text('last-name', '',
                                                ['class' => 'form-last-name form-control', 'placeholder' => trans('login.last_name')]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::email('text-email', '',
                                                ['class' => 'form-email form-control', 'placeholder' => trans('login.email')]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::password('text-password',
                                                ['class' => 'form-email form-control','placeholder' => trans('login.password')])!!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::password('text-password',
                                                ['class' => 'form-email form-control','placeholder' => trans('login.repassword')])
                                            !!}
                                        </div>
                                        <div class="row  button-option">
                                            <div class="col-sm-6">
                                                {!! Form::button(trans('login.register') . '!', ['class' => 'btn']) !!}
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::button(trans('login.sign_in') . '!', ['class' => 'btn']) !!}
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
