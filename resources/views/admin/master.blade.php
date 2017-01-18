<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    {!! Html::style('assets/img/favicon.ico', ['type' => 'image/png', 'rel' => 'icon']) !!}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    {!! Html::style('http://fonts.googleapis.com/css?family=Roboto:400,700,300', ['type' => 'text/css']) !!}
    {!! Html::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') !!}
    {!! Html::style(elixir('/admin/css/bootstrap.css')) !!}
    {!! Html::style(elixir('/admin/css/bootstrap.min.css')) !!}
    {!! Html::style(elixir('/css/app.css')) !!}
    {!! Html::script(elixir('/admin/js/jquery.js')) !!}
    {!! Html::script(elixir('/admin/js/bootstrap.min.js')) !!}
    {!! Html::script(elixir('/admin/js/admin-script.js')) !!}
    {!! Html::script(elixir('/admin/js/chart.js')) !!}

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="" class="simple-text">
                        {!! trans('admin.adminArea') !!}
                    </a>
                </div>
                <ul class="nav">
                    <li class="active">
                        <a href="">
                            <i class="pe-7s-graph"></i>
                            <p>{{ trans('admin.dashboard') }}</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="pe-7s-user"></i>
                            <p>{{ trans('generate.list') }} {{ trans('generate.user') }}</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="pe-7s-note2"></i>
                            <p>{{ trans('generate.list') }} {{ trans('generate.survey') }}</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="pe-7s-bell"></i>
                            <p>{{ trans('generate.notification') }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            @include('admin.blocks.menu')
            <!-- begin content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- end content -->
            @include('admin.blocks.footer')
        </div>
    </div>
</body>
</html>
