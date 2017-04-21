<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ action('Admin\DashboardController@index') }}">
                {{ trans('admin.dashboard') }}
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <li class ="dropdown">
                   <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-search"></i>
                    </a>
                    {!! Form::open(['action' => 'Admin\UserController@search', 'method' => 'GET']) !!}
                    <ul class="dropdown-menu">
                        <li class="dropdown">
                            {!! Form::text('search', '', ['class' => 'form-control', 'placeholder' => trans('generate.search')]) !!}
                        </li>
                    </ul>
                    {!! Form::close() !!}
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="{{ action('Admin\UserController@show', [Auth::user()->id]) }}">
                       {{ Auth::user()->name }}
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ trans('generate.profile') }}
                            <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li>
                           <a href="{{ action('Admin\UserController@show', [Auth::user()->id]) }}">
                               {{ trans('generate.account') }}
                            </a>
                        </li>
                        <li><a href="">{{ trans('generate.create.survey') }}</a></li>
                        <li>
                            <a href="">{{ trans('generate.invite') }}</a>
                        </li>
                        <li><a href="">{{ trans('admin.go_home') }}</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ action('Auth\LoginController@logout') }}">
                                {{ trans('generate.logout') }}
                            </a>
                        </li>
                      </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
