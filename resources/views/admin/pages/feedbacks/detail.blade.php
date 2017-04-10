@extends('admin.master')
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('admin.edit') }} {{ trans('generate.profile') }}</h4>
            </div>
            @include('admin.blocks.alert')
            <div class="content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label(trans('admin.edmail')) !!}
                            {!! Form::email('email', $feedback->email, [
                                'class' => 'form-control',
                                'placeholder' => trans('generate.email'),
                                'disabled' => 'true',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label(trans('generate.name')) !!}
                            {!! Form::text('name', $feedback->name, [
                                'class' => 'form-control',
                                'placeholder' => trans('generate.name'),
                                'disabled' => 'true',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label(trans('generate.content')) !!}
                            {!! Form::text('content', $feedback->content, [
                                'class' => 'form-control',
                                'disabled' => 'true',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
