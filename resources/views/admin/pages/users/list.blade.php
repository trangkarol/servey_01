@extends('admin.master')
@section('content')
<div class="row">
    <div class="hide" data-route="{!! url('/') !!}"></div>
    <div class="col-md-12">
        {!! Form::open(['action' => ['Admin\UserController@changeStatus', config('users.status.block')]]) !!}
            <div class="card">
                <div class="header">
                    <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                </div>
                @include('admin.blocks.alert')
                @include('admin.blocks.list-user', [
                    'users' => $userActives,
                    'type' => config('users.status.active')
                ])
            </div>
        {!! Form::button(trans('compoment.action.block'),['class' => 'btn btn-primary', 'id' => 'blockButton', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-12">
        {!! Form::open(['action' => ['Admin\UserController@changeStatus', config('users.status.active')]]) !!}
            <div class="card card-plain">
                <div class="header">
                    <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                    <p class="category">{{ trans('generate.exampe') }}</p>
                </div>
                @include('admin.blocks.list-user', [
                    'users' => $userBlocks,
                    'type' => config('users.status.block')
                ])
            </div>
                {!! Form::button(trans('compoment.action.active'), [
                        'class' => 'btn btn-primary',
                        'id' => 'activeButton',
                        'type' => 'submit'
                ]) !!}
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-md-12 offset-6">
            {{ $users->render() }}
        </div>
    </div>
    <div class="popup-container">
            <div class="popup-delete col-md-12" id="form-request">
                <!-- Request Form -->
                {!! Form::open(['action' => 'Admin\RequestController@store']) !!}
                <div class="table-popup content table-responsive table-full-width">
                    <table class="popup-table table table-hover">
                          <tr>
                            <td colspan="3">
                               <h4>{{ trans('component.reason') }}</h4>
                            </td>
                        </tr>
                         <tr>
                            <td>{{ trans('component.email_of_user') }}</td>
                            <td colspan="2">
                                <span id="emailUser"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('component.input_content') }}</td>
                            <td colspan="2">
                                {!! Form::text('txtContent', '', [
                                    'class' => 'form-control',
                                    'id' => 'requestContent'
                                ]) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans('component.action_type') }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        {!! Form::radio('data-option', config('users.level.user'), [
                                            'class' => 'radio-block'
                                        ]) !!}
                                        {{ trans('component.block') }}
                                    </div>
                                    <div class="col-md-2">
                                        {!! Form::radio('data-option', config('users.level.admin'), [
                                            'class' => 'radio-block'
                                        ]) !!}
                                        {{ trans('component.update_admin') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-1">
                                        {!! Form::button(trans('compoment.action.send'), [
                                            'class' => 'bt-send-request form-control',
                                            'data-url' => action('Admin\RequestController@store'),
                                            'data-href' => action('Admin\UserController@index'),
                                        ]) !!}
                                    </div>
                                    <div class="col-md-5">
                                        {!! Form::button(trans('compoment.action.cancel'), [
                                            'class' => 'bt-send-cancel form-control',
                                        ]) !!}
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                </div>
                <!-- END Request Form -->
            </div>
    </div>
</div>
@endsection
