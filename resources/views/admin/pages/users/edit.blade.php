@extends('admin.master')
@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ trans('admin.edit') }} {{ trans('generate.profile') }}</h4>
        </div>
        @include('admin.blocks.alert')
        <div class="content">
            {!! Form::open([
                'action' => ['Admin\UserController@update', $user->id],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data'
            ]) !!}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label(trans('admin.edmail')) !!}
                            {!! Form::email('email', $user->email, [
                                'class' => 'form-control',
                                'placeholder' => trans('generate.email'),
                                'disabled' => 'true',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label(trans('generate.name')) !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => trans('generate.name')]) !!}
                        </div>
                        <div class="form-group">
                            @if ($errors->has('name'))
                                <div class="alert alert-warning">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.birthday')) !!}
                            {!! Form::date('birthday', $user->birthday, ['class' => 'form-control', 'placeholder' => trans('generate.birthday')]) !!}
                        </div>
                        <div class="form-group">
                            @if ($errors->has('birthday'))
                                <div class="alert alert-warning">
                                    {{ $errors->first('birthday') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.gender.name')) !!}
                        </div>
                        <div class = "form-group">
                            {!! Form::select('gender', [
                                    '0' => trans('generate.gender.male'),
                                    '1' => trans('generate.gender.female')
                                ],
                                $user->gender, [
                                    'class' => 'inputtext',
                                    'id' => 'gender'
                                ]
                            ) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.address')) !!}
                            {!! Form::text('address', $user->address, ['class' => 'form-control', 'placeholder' => trans('generate.address')]) !!}
                        </div>
                        <div class="form-group">
                            @if ($errors->has('address'))
                                <div class="alert alert-warning">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.phone')) !!}
                            {!! Form::text('phone', $user->phone, ['class' => 'form-control', 'placeholder' => trans('generate.phone')]) !!}
                        </div>
                        <div class="form-group">
                            @if ($errors->has('phone'))
                                <div class="alert alert-warning">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.avatar')) !!}
                            {!! Form::file('image') !!}
                        </div>
                        <div class="form-group">
                            @if ($errors->has('image'))
                                <div class="alert alert-warning">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::button(trans('generate.update'), [
                    'class' => 'btn btn-info btn-fill pull-right',
                    'type' => 'submit',
                ]) !!}
                <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card card-user">
        <div class="image">
            {!!
                Html::image('https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400')
            !!}
        </div>
        <div class="content">
            <div class="author">
                 <a href="#">
                {!! Form::model($user, [
                    'action' => ['Admin\UserController@update', $user->id],
                    'class' => 'form-horizontal',
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                {!! Html::image($user->image, 'userAvatar', ['class' => 'avatar border-gray']) !!}
                  <h4 class="title">{{ $user->name }}<br />
                     <small>{{ $user->email }}</small>
                  </h4>
                </a>
            </div>
            <p class="description text-center">{{ $user->birthday }}
                </br>
                    {{ ($user->gender == config('users.gender.male')) ? trans('generate.gender.male') : trans('generate.gender.female')}}
                </br>
                    {{ $user->address }}
                </br>
                    {{ $user->phone }}
            </p>
        </div>
        <hr>
    </div>
</div>
@endsection
