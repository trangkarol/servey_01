@extends('user.master')
@section('content')
    @include('user.blocks.list-container')
@endsection
@section('content-bot')
    <div class="inner">
        @if (!Auth::check())
            <section>
                <h2>{{ trans('home.register_now') }}</h2>
                {!! Form::open(['action' => 'Auth\RegisterController@register']) !!}
                    <div class="field half first">
                        {!! Form::email('email', '', [
                            'placeholder' => trans('login.email'),
                            'id' => 'email',
                        ]) !!}
                    </div>
                    <div class="field half">
                        {!! Form::text('first-name', '', [
                            'placeholder' => trans('login.first_name'),
                            'id' => 'first-name',
                        ]) !!}
                    </div>
                    <div class="field half first">
                        {!! Form::password('password', [
                            'id' => 'password',
                            'placeholder' => trans('login.password'),
                        ]) !!}
                    </div>
                    <div class="field half">
                        {!! Form::text('last-name', '', [
                            'placeholder' => trans('login.last_name'),
                            'id' => 'last-name',
                        ]) !!}
                    </div>
                    <div class="field half first">
                        {!! Form::password('password_confirmation', [
                            'id' => 'password-confirm',
                            'placeholder' => trans('login.repassword'),
                        ]) !!}
                    </div>
                    <div class="field first">
                        @if (
                            $errors->has('email') ||
                            $errors->has('password') ||
                            $errors->has('password_confirmation') ||
                            $errors->has('first-name') ||
                            $errors->has('last-name')
                        )
                            <div class="alert alert-warning">
                                <p>{{ $errors->first('email') }}</p>
                                <p>{{ $errors->first('password') }}</p>
                                <p>{{ $errors->first('password_confirmation') }}</p>
                                <p>{{ $errors->first('first-name') }}</p>
                                <p>{{ $errors->first('last-name') }}</p>
                            </div>
                        @endif
                    </div>
                    <ul class="actions">
                        <li>
                            {!! Form::submit('Register', ['class' => 'special']) !!}
                            {!! Form::button('Login', [
                                'class' => 'bt-login special bt-action',
                                'url' => action('SurveyController@getHome')
                            ]) !!}
                        </li>
                    </ul>
                {!! Form::close() !!}
            </section>
            @include('user.blocks.social')
        @endif
    </div>

@endsection
