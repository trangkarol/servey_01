@extends('user.master-login')
@section('content')
<div class="col-sm-6 row div-register">
    <div class="form-box col-sm-offset-1 col-sm-11">
        <div class="form-top">
            <div class="form-top-left">
                <h3>{{ trans('login.sign_up_now') }}</h3>
                <p>{{ trans('login.fill_in_form') }}</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-pencil"></i>
            </div>
        </div>
        <div class="form-bottom">
            {!! Form::open(['action' => 'Auth\RegisterController@register']) !!}
                <div class="form-group">
                    {!! Form::text('first-name', '', [
                        'class' => 'form-last-name form-control',
                        'placeholder' => trans('login.first_name'),
                        'required' => 'true'
                    ]) !!}
                </div>
                <div class="form-group">
                    @if ($errors->has('first-name'))
                        <div class="alert alert-warning">
                            {{ $errors->first('first-name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::text('last-name', '', [
                        'class' => 'form-last-name form-control',
                        'placeholder' => trans('login.last_name'),
                        'required' => 'true'
                    ]) !!}
                </div>
                <div class="form-group">
                    @if ($errors->has('last-name'))
                        <div class="alert alert-warning">
                            {{ $errors->first('last-name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::email('email', '', [
                        'id' => 'email',
                        'class' => 'form-email form-control',
                        'placeholder' => trans('login.email'),
                        'required' => 'true'
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
                        'id' => 'password',
                        'class' => 'form-email form-control',
                        'placeholder' => trans('login.password'),
                        'required' => 'true'
                    ]) !!}
                </div>
                <div class="form-group">
                    @if ($errors->has('password'))
                        <div class="alert alert-warning">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::password('password_confirmation', [
                        'id' => 'password-confirm',
                        'class' => 'form-control',
                        'placeholder' => trans('login.repassword'),
                        'required' => 'true'
                    ]) !!}
                </div>
                <div class="row  button-option">
                    <div class="col-sm-6">
                        {!! Form::button(trans('login.register') . '!', ['class' => 'btn', 'type' => 'submit']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::button(trans('login.sign_in') . '!', ['class' => 'btn']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
