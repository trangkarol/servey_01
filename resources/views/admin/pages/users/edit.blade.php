@extends('admin.master')
@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="header">
            <h4 class="title">{{ trans('admin.edit') }} {{ trans('generate.profile') }}</h4>
        </div>
        <div class="content">
            {!! Form::open() !!}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label(trans('admin.company')) !!}
                            {!! Form::text('', '', [
                                    'class' => 'form-control',
                                    'placeholder' => trans('admin.company'),
                                    'disabled' => 'true',
                                ])
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label(trans('generate.name')) !!}
                            {!! Form::text('', '', ['class' => 'form-control', 'placeholder' => trans('generate.name')]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.email')) !!}
                            {!! Form::email('', '', ['class' => 'form-control', 'placeholder' => trans('generate.email')]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::button(trans('generate.update'), [
                        'class' => 'btn btn-info btn-fill pull-right',
                        'type' => 'submit',
                    ])
                !!}
                <div class="clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card card-user">
        <div class="image">
            {!!
                Form::image('https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400')
            !!}
        </div>
        <div class="content">
            <div class="author">
                 <a href="#">
                {!! Form::image('userAvatar', '', ['class' => 'avatar border-gray']) !!}
                  <h4 class="title">{{ trans('generate.name') }}<br />
                     <small>{{ trans('generate.email') }}</small>
                  </h4>
                </a>
            </div>
            <p class="description text-center">{{ trans('generate.exampe') }}
                </br>
                    {{ trans('generate.exampe') }}
                </br>
                    {{ trans('generate.exampe') }}
            </p>
        </div>
        <hr>
    </div>
</div>
@endsection
