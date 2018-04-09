@extends('clients.layout.master')
@section('content')
   <div class="container">
        <div class="col-md-4 offset-md-4">
            <div class="form-reset-password">
                {{ Form::open(['route' => 'reset-password', 'method' => 'POST']) }}
                    {{ Form::hidden('token', $token) }}
                    @if (Session::has('exception'))
                        <div class="alert alert-danger">
                            <span class="help-block">{{ Session::get('exception') }}</span>
                        </div>
                    @endif
                    <div class="md-form mb-5">
                        {{ Form::email('email', old('email'), [
                            'class' => 'form-control validate',
                            'placeholder' => trans('lang.email_placeholder'),
                        ]) }}
                        {{ Form::label('email', trans('lang.email')) }}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="md-form mb-5">
                        {{ Form::password('password', [
                            'class' => 'form-control validate',
                            'placeholder' => trans('lang.password_placeholder'),
                        ]) }}
                        {{ Form::label('password', trans('lang.password')) }}
                         @if ($errors->has('password'))
                            <span class="help-block">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                    <div class="md-form mb-3">
                        {{ Form::password('password_confirmation', [
                            'class' => 'form-control validate',
                            'placeholder' => trans('lang.password_placeholder'),
                        ]) }}
                        {{ Form::label('password_confirmation', trans('lang.password_confirmation')) }}
                    </div>
                    <div class="text-center mb-3">
                        {{ Form::button(trans('lang.reset_password'), ['type' => 'submit', 'class' => 'btn blue-gradient btn-block btn-rounded z-depth-1a' ]) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
