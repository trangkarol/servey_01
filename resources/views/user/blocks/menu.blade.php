<header>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-xs-3" id="logo">
                <a href="{{ action('SurveyController@index') }}"></a>
            </div>
            <nav class="col-md-8 col-xs-9" id="top-nav">
                <ul>
                    <li>
                        <a href="{{ action('SurveyController@index') }}">
                            <span class="glyphicon glyphicon-home">
                            </span>
                            {{ trans('home.home') }}
                        </a>
                    </li>
                    @if (!Auth::guard()->check())
                        <li>
                            <a href="{{ action('Auth\LoginController@getLogin') }}">
                                <span class="glyphicon glyphicon-log-in span-menu">
                                </span>
                                {{ trans('login.login') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('Auth\RegisterController@getRegister') }}">
                                <span class="glyphicon glyphicon-registration-mark span-menu">
                                </span>
                                {{ trans('login.register') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ action('SurveyController@listSurveyUser') }}">
                                <span class="glyphicon glyphicon-th">
                                </span>
                                {{ trans('home.list_survey') }}
                            </a>
                        </li>
                        <li>
                        <span>
                            {!! Html::image(Auth::user()->image, '', [
                                'class' => 'image-avatar',
                            ]) !!}
                         </span>
                            <a href="{{ action('User\UserController@show') }}">
                                {{ Auth::user()->part_name }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ action('Auth\LoginController@logout') }}">
                                <span class="glyphicon glyphicon-log-out">
                                </span>
                                {{ trans('login.logout') }}
                            </a>
                        </li>
                    @endif
                    <li>
                        {!! Form::select('language', config('settings.language'), Session::get('locale'), [
                            'id' => 'langs',
                            'data-url' => action('LanguageController@index'),
                        ]) !!}
                    </li>
                </ul>
            </nav>
        </div>
     </div>
</header>
