<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@lang('lang.web_title')</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <!-- Plugins CSS -->
        {{ Html::style(asset('css/bootstrap.min.css')) }}
        {{ Html::style(asset('plugins/font-awesome/css/font-awesome.min.css')) }}
        <!-- Theme CSS -->
        {{ Html::style(elixir(config('settings.public_template') . 'css/home.css')) }}
        {{ Html::style(elixir(config('settings.public_template') . 'css/style.css')) }}
    </head>
    <body class="home-page">     
        <div class="header-wrapper header-wrapper-home">
            <!-- ******HEADER****** --> 
            <header id="header" class="header fixed-top">  
                <div class="container">       
                    <h1 class="logo">
                        <a href="#">{!! config('settings.logo_content') !!}</a>
                    </h1>
                    <nav class="main-nav navbar navbar-expand-md navbar-dark" role="navigation">
                        {{ Form::button('<span class="navbar-toggler-icon"></span>', ['class' => 'navbar-toggler', 
                            'data-toggle' => 'collapse', 'data-target' => '#navbar-collapse', 'aria-controls' => 'navbar-collapse', 
                            'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation']) }}
                        <div id="navbar-collapse" class="navbar-collapse collapse justify-content-end">
                            <ul class="nav navbar-nav">
                                <li class="active nav-item">
                                    {{ Html::link('#', trans('lang.home'), ['class' => 'nav-link']) }}
                                </li>
                                <li class="nav-item">
                                    {{ Html::link('#', trans('lang.feedback'), ['class' => 'nav-link']) }}
                                </li>                                              
                                <li class="nav-item">
                                    {{ Html::link('#', trans('lang.login'), ['class' => 'nav-link']) }}
                                </li>
                                <li class="nav-item">
                                    {{ Html::link('#', trans('lang.register'), ['class' => 'nav-link']) }}
                                </li>
                                <li class="nav-item dropdown notifications">
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
                                <li class="nav-item dropdown user-dropdown last">
                                    <a class="nav-link dropdown-toggle user-nav-show" href="#" id="navbarDropdownProfile" 
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                        <span class="user-profile">
                                            {{ Html::image('', '', ['class' => 'user-images']) }}
                                            <span class="user-name d-none-992"></span> <!--username here-->
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right header-menu" aria-labelledby="navbarDropdownProfile">
                                        <li class="notify-header"> 
                                            @lang('lang.hello') <!--username here-->
                                        </li>
                                        <li> 
                                            {{ Html::link('#', trans('lang.my_surveys'), ['class' => 'dropdown-item']) }}
                                        </li>
                                        <li> 
                                            {{ Html::link('#', trans('lang.settings'), ['class' => 'dropdown-item']) }}
                                        </li>
                                        <li>
                                            {{ Html::link('#', trans('lang.logout'), ['class' => 'dropdown-item']) }}
                                        </li>
                                        <li class="notify-footer"></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
        </div>
