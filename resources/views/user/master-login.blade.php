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
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
