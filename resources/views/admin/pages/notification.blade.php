@extends('admin.master')
@section('content')
<div class="card">
    <div class="header">
        <h4 class="title">{{ trans('generate.notification') }}</h4>
        <p class="category"><a target="_blank" href="">{{ trans('generate.exampe') }}</a>{{ trans('generate.exampe') }}
            <a href="" target="_blank">{{ trans('generate.exampe') }}</a>
        </p>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <h5>{{ trans('generate.exampe') }}</h5>
                <div class="alert alert-info">
                    <span>{{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-info">
                    {!! Form::button(trans('generate.close'), ['class' => 'close', 'aria-hidden' => 'true', 'value' => '']) !!}
                    <span>{{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    {!! Form::button(trans('generate.close'), ['class' => 'close', 'aria-hidden' => 'true', 'value' => '']) !!}
                    <span data-notify="icon" class="pe-7s-bell"></span>
                    <span data-notify="message">{{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-info alert-with-icon" data-notify="container">
                    {!! Form::button(trans('generate.close'), ['class' => 'close', 'aria-hidden' => 'true', 'value' => '']) !!}
                    <span data-notify="icon" class="pe-7s-bell"></span>
                    <span data-notify="message">{{ trans('generate.exampe') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <h5>{{ trans('generate.exampe') }}</h5>
                <div class="alert alert-info">
                    {!! Form::button(trans('generate.close'), [
                            'class' => 'close',
                            'aria-hidden' => 'true',
                            'value' => ''
                        ])
                    !!}
                    <span><b>{{ trans('generate.exampe') }}</b>{{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-success">
                    {!! Form::button(trans('generate.close'), [
                            'class' => 'close',
                            'aria-hidden' => 'true',
                            'value' => ''
                        ])
                    !!}
                    <span><b>{{ trans('generate.exampe') }}</b> {{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-warning">
                    {!! Form::button(trans('generate.close'), [
                            'class' => 'close',
                            'aria-hidden' => 'true',
                            'value' => ''
                        ])
                    !!}
                    <span><b> {{ trans('generate.exampe') }}</b> {{ trans('generate.exampe') }}</span>
                </div>
                <div class="alert alert-danger">
                    {!! Form::button(trans('generate.close'), [
                            'class' => 'close',
                            'aria-hidden' => 'true',
                            'value' => ''
                        ])
                    !!}
                    <span><b> {{ trans('generate.exampe') }} </b> {{ trans('generate.exampe') }}</span>
                </div>
            </div>
        </div>
        </br>
        </br>
        <div class="places-buttons">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5>{{ trans('generate.exampe') }}
                        <p class="category">{{ trans('generate.exampe') }}</p>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-3">
                    {!! Form::button(trans('admin.top.left'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('top','left')"
                        ])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Form::button(trans('admin.top.center'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('top','center')"
                        ])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Form::button(trans('admin.top.right'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('top','right')"
                        ])
                    !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-3">
                    {!! Form::button(trans('admin.bottom.left'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('bottom','left')"
                        ])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Form::button(trans('admin.bottom.center'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('bottom','center')"
                        ])
                    !!}
                </div>
                <div class="col-md-2">
                    {!! Form::button(trans('admin.bottom.right'), [
                            'class' => 'btn btn-default btn-block',
                            'onclick' => "charts.showNotification('bottom','right')"
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
