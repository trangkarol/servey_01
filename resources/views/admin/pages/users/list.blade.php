@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>{{ trans('generate.avatar') }}</th>
                        <th>{{ trans('generate.id') }}</th>
                        <th>{{ trans('generate.name') }}</th>
                        <th>{{ trans('generate.email') }}</th>
                        <th>{{ trans('generate.birthday')}}</th>
                        <th>{{ trans('generate.address') }}</th>
                        <th>{{ trans('generate.phone') }}</th>
                        <th>{{ trans('generate.gender') }}</th>
                        <th>{{ trans('generate.status.generate') }}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('generate.user') }}</h4>
                <p class="category">{{ trans('generate.exampe') }}</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                        <th>{{ trans('generate.avatar') }}</th>
                        <th>{{ trans('generate.id') }}</th>
                        <th>{{ trans('generate.name') }}</th>
                        <th>{{ trans('generate.email') }}</th>
                        <th>{{ trans('generate.birthday')}}</th>
                        <th>{{ trans('generate.address') }}</th>
                        <th>{{ trans('generate.phone') }}</th>
                        <th>{{ trans('generate.gender') }}</th>
                        <th>{{ trans('generate.status.generate') }}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                            <td>{{ trans('generate.exampe') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
