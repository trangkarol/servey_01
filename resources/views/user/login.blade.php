@extends('user.master-login')
@section('content')
<div class="col-sm-6 div-login">
    <div class="form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>{{ trans('login.login_our') }}</h3>
                <p>{{ trans('login.enter_username') }}</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        <div class="form-bottom">
            {!! Form::open(['action' => 'Auth\LoginController@login']) !!}
                <div class="form-group">
                    {!! Form::email('email', '', [
                        'class' => 'form-username form-control',
                        'placeholder' => trans('login.email')
                    ]) !!}
                </div>
                <div class="form-group">
                    @if ($errors->has('email'))
                        <div class="alert alert-warning">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::password('password', [
                        'class' => 'form-password form-control',
                        'placeholder' => trans('login.password')
                    ]) !!}
                </div>
                <div class="form-group">
                    @if ($errors->has('password'))
                        <div class="alert alert-warning">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="alert-message">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">
                            {{Session::get('message')}}
                        </div>
                    @endif
                </div>
                <div class="row button-option">
                    <div class="col-sm-4">
                        {!! Form::button(trans('login.register'), ['class' => 'btn']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::button(trans('login.sign_in'), [
                            'type' => 'submit',
                            'class' => 'btn'
                        ]) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::button('<i class="fa fa-google-plus"></i> ' . trans('login.google_plus'),[
                            'type' => 'submit', 'class' => 'btn'
                        ]) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
