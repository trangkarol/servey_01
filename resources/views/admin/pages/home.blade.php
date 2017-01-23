@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.exampe') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content">
                <div id="chartPreferences" class="ct-chart ct-perfect-fourth">
                </div>
                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> {{ trans('generate.exampe') }}
                        <i class="fa fa-circle text-danger"></i> {{ trans('generate.exampe') }}
                        <i class="fa fa-circle text-warning"></i> {{ trans('generate.exampe') }}
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> {{ trans('generate.exampe') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.exampe') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content">
                <div id="chartHours" class="ct-chart"></div>
                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> {{ trans('generate.exampe') }}
                        <i class="fa fa-circle text-danger"></i> {{ trans('generate.exampe') }}
                        <i class="fa fa-circle text-warning"></i> {{ trans('generate.exampe') }}
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> {{ trans('generate.exampe') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">{{ trans('generate.exampe') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content">
                <div id="chartActivity" class="ct-chart"></div>
                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> {{ trans('generate.exampe') }}
                        <i class="fa fa-circle text-danger"></i> {{ trans('generate.exampe') }}
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-check"></i> {{ trans('generate.exampe') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">{{ trans('generate.exampe') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content">
                <div class="table-full-width">
                    <table class="table">
                        <tbody>
                        <td></td>
                        <td>{{ trans('generate.id') }}</td>
                        <td>{{ trans('generate.title') }}</td>
                        @foreach ($surveys as $survey)
                            <tr>
                                <td>{{ $survey->id }}</td>
                                <td>{{ $survey->title }}</td>
                                <td class="td-actions text-right">
                                    {!! Form::button('<i class="fa fa-edit"></i>',
                                        [
                                            'class' => 'btn btn-info btn-simple btn-xs',
                                            'title' => trans('admin.edit'),
                                            'rel' => 'tooltip'
                                        ])
                                    !!}
                                    {!! Form::button('<i class="fa fa-remove"></i>',
                                        [
                                            'class' => 'btn btn-info btn-simple btn-xs',
                                            'title' => trans('admin.remove'),
                                            'rel' => 'tooltip'
                                        ])
                                    !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i>{{ trans('generate.exampe') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
