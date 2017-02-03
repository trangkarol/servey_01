<!DOCTYPE HTML>
<html>
    <head>
        <title>{{ trans('home.get_survey') }}!</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ Html::style(elixir('/admin/css/bootstrap.css')) }}
        {{ Html::style(elixir('/user/css/main.css')) }}
        {{ Html::style(elixir('/user/css/home.css')) }}
    </head>
    <body>
        <input type="hidden" data-number="0" class="data" ms-error="{{ trans('home.error') }}"/>
        <!-- Wrapper -->
        <div id="wrapper">
        <!-- Header -->
            <header id="header">
                <div class="inner">
                    <!-- Logo -->
                    <a href="" class="logo">
                        <span class="symbol">
                            {{ Html::image("demo/images/logo.png") }}
                        </span>
                        <span class="title">{{ trans('home.survey') }}</span>
                    </a>
                    <!-- Nav -->
                    <nav>
                        <ul>
                            <li><a href="#menu">{{ trans('home.menu') }}</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
        <!-- Menu -->
                @include('user.blocks.menu')
        <!-- Main -->
            <div id="main">
                @yield('content')
            </div>
        <!-- Footer -->
            <footer id="footer">
                @yield('content-bot')
            </footer>
        </div>
        <!-- Scripts -->
        {{ Html::script(elixir('/user/js/jquery.min.js')) }}
        {{ Html::script(elixir('/user/js/skel.min.js')) }}
        {{ Html::script(elixir('/user/js/util.js')) }}
        {{ Html::script(elixir('/user/js/main.js')) }}
        {{ Html::script(elixir('/user/js/question.js')) }}
        {{ Html::script(elixir('/js/app.js')) }}
    </body>
</html>
