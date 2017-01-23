@extends('admin.master')
@section('content')
<div class="row">
    <div class="hide" data-route="{!! url('/') !!}"></div>
    <div class="col-md-12">
    {!! Form::open(['action' => ['Admin\UserController@changeStatus', config('users.status.block')]]) !!}
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            @include('admin.blocks.alert')
            @include('admin.blocks.list-user', ['users' => $userActives])
        </div>
        {!! Form::button(trans('admin.block'),['class' => 'btn btn-primary', 'id' => 'blockButton', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-12">
        {!! Form::open(['action' => ['Admin\UserController@changeStatus', config('users.status.active')]]) !!}
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            @include('admin.blocks.list-user', ['users' => $userBlocks])
        </div>
            {!!
                Form::button(trans('admin.active'),['class' => 'btn btn-primary', 'id' => 'activeButton', 'type' => 'submit'])
            !!}
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-md-12 offset-6">
            {{ $users->render() }}
        </div>
    </div>
</div>
@endsection
