<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">{{ trans('admin.dashboard') }}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-globe"></i>
                            <b class="caret"></b>
                            <span class="notification">5</span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                      </ul>
                </li>
                <li>
                   <a href="">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="">
                       {{ trans('generate.account') }}
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ trans('generate.exampe') }}
                            <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                        <li class="divider"></li>
                        <li><a href="#">{{ trans('generate.exampe') }}</a></li>
                      </ul>
                </li>
                <li>
                    <a href="#">
                        {{ trans('generate.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
