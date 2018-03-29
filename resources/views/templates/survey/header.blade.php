<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@lang('lang.web_title')</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Plugins CSS -->
        {!! Html::style(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'font-awesome/css/font-awesome.min.css')) !!}
        {!! Html::style(asset(config('settings.plugins') . 'ionicons/css/ionicons.min.css')) !!}
        <!-- Theme CSS -->
        {!! Html::style(elixir(config('settings.public_template') . 'css/home.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/modal-auth.min.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'js/datepicker/bootstrap-datepicker.min.css')) !!}
        {!! Html::style(elixir(config('settings.public_template') . 'css/style.css')) !!}
        @stack('styles')
    </head>
    <body class="home-page">
        <div class="site">
            <div class="site-loader">
              <div class="site-loader-spinner"></div>
            </div> <!-- .site-loader -->
        </div>
        <div class="header-wrapper header-wrapper-home">
            <!-- ******HEADER****** -->
            <header id="header" class="header fixed-top mobile-header @yield('header-change')">
                <div class="container">
                    <h1 class="logo">
                        <a href="{{ route('home') }}">{!! config('settings.logo_content') !!}</a>
                    </h1>
                    <nav class="main-nav navbar navbar-expand-md navbar-dark" role="navigation">
                        {{ Form::button('<span class="navbar-toggler-icon"></span>', ['class' => 'navbar-toggler',
                            'data-toggle' => 'collapse', 'data-target' => '#navbar-collapse', 'aria-controls' => 'navbar-collapse',
                            'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation']) }}
                        <div id="navbar-collapse" class="navbar-collapse collapse justify-content-end">
                            <ul class="nav navbar-nav">
                                <li class="active nav-item">
                                    {{ Html::link(route('home'), trans('lang.home'), ['class' => 'nav-link']) }}
                                </li>
                                <li class="nav-item">
                                    {{ Html::link('#', trans('lang.feedback'), ['class' => 'nav-link']) }}
                                </li>
                                @if (!Auth::guard()->check())
                                    <li class="nav-item">
                                        {{ Html::link('#', trans('lang.login'), [
                                            'class' => 'nav-link',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#modalLogin',
                                        ]) }}
                                    </li>
                                    <li class="nav-item">
                                        {{ Html::link('#', trans('lang.register'), [
                                            'class' => 'nav-link',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#modalRegister'
                                        ]) }}
                                    </li>
                                @else
                                    <li class="nav-item notifications">
                                        <a class="nav-link dropdown-toggle" href="#" id="navNotifications"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="notify fa fa-bell-o"></span>
                                            <span class="round fa fa-cirlce"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right header-menu" aria-labelledby="navNotifications">
                                            <li class="notify-header">
                                                @lang('lang.notifications')
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="text-success">@lang('lang.congrats') </span> <!-- notification message here-->
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="text-danger">@lang('lang.failure')</span> <!-- notification message here-->
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="text-warning">@lang('lang.notifications')</span> <!-- notification message here-->
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="text-danger">@lang('lang.warning')</span> <!-- notification message here-->
                                                </a>
                                            </li>
                                            <li class="notify-footer"></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item user-dropdown last">
                                        <a class="nav-link dropdown-toggle user-nav-show" href="#" id="navbarDropdownProfile"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="user-profile">
                                                {{ Html::image(Auth::user()->image, '', ['class' => 'user-images']) }}
                                                <span class="user-name d-none-992"></span> {{ Auth::user()->name }}
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right header-menu" aria-labelledby="navbarDropdownProfile">
                                            <li class="notify-header">
                                                @lang('lang.hello') {{ Auth::user()->name }}
                                            </li>
                                            <li>
                                                {{ Html::link('#', trans('lang.my_surveys'), ['class' => 'dropdown-item']) }}
                                            </li>
                                            <li>
                                                {{ Html::link('#', trans('lang.settings'), ['class' => 'dropdown-item']) }}
                                            </li>
                                            <li>
                                                {{ Html::link(route('logout'), trans('lang.logout'), ['class' => 'dropdown-item']) }}
                                            </li>
                                            <li class="notify-footer"></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
        </div>
