@extends('user.master')
@section('content')
    @include('user.blocks.list-container')
@endsection
@section('content-bot')
    <div class="inner">
        @if (!Auth::check())
            <section>
                <h2>{{ trans('home.login_now') }}</h2>
                {!! Form::open(['action' => 'Auth\LoginController@login']) !!}
                    <div class="field half first">
                        {!! Form::email('email', '', [
                            'placeholder' => 'Email',
                            'id' => 'email',
                        ]) !!}
                    </div>
                    <div class="field half">
                        {!! Form::password('password', [
                            'id' => 'password',
                            'placeholder' => trans('login.password'),
                        ]) !!}
                    </div>
                    <div class="field half first">
                        @if ($errors->has('email'))
                            <div class="alert alert-warning">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="field half">
                        @if ($errors->has('password'))
                            <div class="alert alert-warning">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="field first">
                        @if (Session::has('message'))
                            <div class="alert alert-warning">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                    </div>
                    <ul class="actions">
                        <li>
                            {!! Form::button('Register', [
                                'class' => 'bt-register special bt-action',
                                'url' => action('Auth\RegisterController@register'),
                            ]) !!}
                            {!! Form::submit('Login', ['class' => 'special']) !!}
                        </li>
                    </ul>
                {!! Form::close() !!}
            </section>
            @include('user.blocks.social')
         @else
             <h2>{{ trans('home.wellcome') }},{{ Auth::user()->name }}</h1>
         @endif
    </div>
@endsection
