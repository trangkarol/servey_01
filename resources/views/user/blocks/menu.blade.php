<nav id="menu">
    <h2>{{ trans('home.menu') }}</h2>
    <ul>
        @if (Auth::check())
            <li>
                {!! Html::image(Auth::user()->image) !!}
                <span>
                    {{ Auth::user()->name }}
                </span>
            </li>
        @endif
        <li>
            <a href="{{ action('SurveyController@getHome') }}">
                {{ trans('home.home') }}
            </a>
        </li>
        <li><a href="">{{ trans('home.profile') }}</a></li>
        <li>
            <a href="{{ action('SurveyController@create') }}">
                {{ trans('home.create_survey') }}
            </a>
        </li>
        <li><a href="">{{ trans('home.update_info') }}</a></li>
        <li><a href="">{{ trans('home.history') }}</a></li>
        <li><a href="{{ (Auth::check()) ?
                action('Auth\LoginController@logout') : action('Auth\LoginController@login')
            }}">
               {{ (Auth::check()) ? trans('home.logout') : trans('home.login') }}
            </a>
        </li>
    </ul>
</nav>
