@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="card">
            <div class="header text-center">
                <h4 class="title">{{ trans('component.list_request') }}</h4>
                <br>
            </div>
            <div class="content table-responsive table-full-width table-upgrade" id="table-request">
                <table class="table table-request">
                    <thead>
                        <th>{{ trans('component.email_user') }}</th>
                        <th>{{ trans('component.admin_send_request') }}</th>
                        <th>{{ trans('component.content') }}</th>
                        <th>{{ trans('component.type') }}</th>
                        <th>{{ trans('component.delete_request') }}</th>
                        <th>{{ trans('component.accept') }}</th>
                        <th>{{ trans('component.action') }}</th>
                    </thead>
                    <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->member->email }}</td>
                            <td>{{ $request->admin->email }}</td>
                            <td>{{ $request->content }}</td>
                            <td>{{ ($request->action_type) ? trans('component.updat_admin') : trans('component.block') }}</td>
                            @if (!$request->status)
                                <td>{!! Form::button('<i class="fa fa-times text-danger"></i>', [
                                    'class' => 'btn btn-info btn-simple btn-xs',
                                    'id' => 'bt-request-delete',
                                    'request-id' => $request->id,
                                    'url' => action('Admin\RequestController@index'),
                                    'data-url' => action('Admin\RequestController@destroy'),
                                ]) !!}
                                </td>
                                <td></td>
                                <td>
                                {!! Form::button(trans('generate.accept'), [
                                    'class' => 'form-control',
                                    'id' => 'bt-request-accept',
                                    'url' => action('Admin\RequestController@index'),
                                    'data-url' => action('Admin\RequestController@update', $request->id),
                                ]) !!}
                            </td>
                            @else
                                <td></td>
                                <td><i class="fa fa-check text-success"></td>
                                <td>{!! Form::button('<i class="fa fa-times text-danger"></i>', [
                                    'class' => 'btn btn-info btn-simple btn-xs',
                                    'id' => 'bt-request-delete',
                                    'request-id' => $request->id,
                                    'url' => action('Admin\RequestController@index'),
                                    'data-url' => action('Admin\RequestController@destroy'),
                                ]) !!}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    {{ $requests->render() }}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
