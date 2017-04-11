@extends('admin.master')
@section('content')
<div class="row" data-route="{{ action('Admin\DashboardController@index') }}" id="survey-list">
    <div class="hide"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ trans('generate.list') }} {{ trans('home.feedback') }}</h4>
            </div>
            @include('admin.blocks.alert')
            <div class="content table-responsive table-full-width" id="table">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>{{ trans('generate.id') }}</th>
                        <th>{{ trans('generate.name') }}</th>
                        <th>{{ trans('generate.email') }}</th>
                        <th>{{ trans('generate.content') }}</th>
                        <th>{{ trans('generate.status.feedback') }}</th>
                        <th>{{ trans('generate.show') }}</th>
                        <th>
                            {{ trans('generate.view.delete', [
                                'object' => class_basename(Feedback::class),
                            ]) }}
                        </th>
                    </thead>
                    @foreach ($feedbacks as $feedback)
                    <tbody class="sva{{ $feedback->id }}">
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $feedback->part_content }}</td>
                            <td>
                                {{ $feedback->status ? trans('generate.feedback.seen') : trans('generate.feedback.not_seen') }}
                            </td>
                            <td>
                                {!! Form::button(trans('generate.show'), [
                                    'class' => 'btn btn-info btn-view-feedback',
                                    'data-url' => action('FeedbackController@show', $feedback->id),
                                    'data-id' => $feedback->id,
                                    'url' => action('FeedbackController@update'),
                                    'data-status' => $feedback->status,
                                ]) !!}
                            </td>
                            <td>
                                {!! Form::open([
                                    'action' => ['FeedbackController@destroy', $feedback->id],
                                    'method' => 'DELETE',
                                ]) !!}
                                    {!! Form::submit(trans('generate.view.delete', ['object' => class_basename(Feedback::class)]), [
                                        'class' => 'btn btn-danger',
                                    ]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{ $feedbacks->render() }}
</div>
@endsection
