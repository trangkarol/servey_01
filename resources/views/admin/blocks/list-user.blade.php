<div class="content table-responsive table-full-width" id="table-{{ $type }}">
    <table class="table table-hover">
        <thead>
            <th>{{ trans('generate.avatar') }}</th>
            <th>{{ trans('generate.id') }}</th>
            <th>{{ trans('generate.name') }}</th>
            <th>{{ trans('generate.email') }}</th>
            <th>{{ trans('generate.birthday')}}</th>
            <th>{{ trans('generate.address') }}</th>
            <th>{{ trans('generate.phone') }}</th>
            <th>{{ trans('generate.gender.name') }}</th>
            <th>{{ trans('generate.status.generate') }}</th>
        </thead>
        @foreach($users as $user)
        <tbody>
            <tr>
                <td>
                    {!! Html::image($user->image, 'userAvatar', ['class' => 'avatar border-gray']) !!}
                </td>
                <td>{{ $user->id }}</td>
                <td>
                    <a href="{{ action('Admin\UserController@show', [$user->id]) }}">{{ $user->name }}</a>
                </td>
                <td>
                    <a href="{{ action('Admin\UserController@show', [$user->id]) }}">{{ $user->email }}</a>
                </td>
                <td>{{ $user->birthday }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    {{ ($user->gender == config('users.gender.male')) ?
                        trans('generate.gender.male') : trans('generate.gender.female')
                    }}
                </td>
                 @if (!$user->requestMember)
                    <td>{{ ($user->status) ? trans('generate.status.active') : trans('generate.status.block') }}</td>
                    @if (!$user->level && $user->status && Auth::user()->isAdmin())
                        <td>
                            {{ Form::button(trans('compoment.action.request'), [
                                'class' => 'form-control',
                                'id' => 'bt-request',
                                'userId' => $user->id,
                                'userEmail' => $user->email,
                            ]) }}
                        </td>
                    @elseif (!$user->level && $user->status && Auth::user()->isSupperAdmin())
                        <td>
                            {{ Form::button(trans('compoment.action.block'), [
                                'class' => 'form-control',
                                'id' => 'bt-block-supperadmin',
                                'table-type' => $type,
                                'data-url' => action('Admin\UserController@changeStatus',
                                    [$user->id,
                                    config('users.status.block')])
                            ]) }}
                        </td>
                        <td>
                            {!! Form::checkbox(($user->status) ?
                                'checkbox-user-active[]' : 'checkbox-user-block[]',
                                $user->id,
                                '', [
                                    'data-toggle' => 'checkbox',
                                    'id-user[]' => $user->id,
                                    'class' => 'bt-form',
                            ]) !!}
                        </td>
                    @endif
                    @if (!$user->status)
                        <td>
                            {!! Form::checkbox(($user->status) ?
                                'checkbox-user-active[]' : 'checkbox-user-block[]',
                                $user->id,
                                '', [
                                    'data-toggle' => 'checkbox',
                                    'id-user[]' => $user->id,
                                    'class' => 'bt-form',
                                ])
                            !!}
                        </td>
                    @else
                        <td></td>
                    @endif
                @else
                    @if (!$user->requestMember->status)
                        <td>{{ trans('generate.status.process') }}</td>
                        <td>
                            {{ Form::button(trans('compoment.action.cancel'), [
                                'class' => 'form-control',
                                'id' => 'bt-cancel',
                                'requestId' => $user->requestMember->id,
                                'request-url' => action('Admin\RequestController@destroy'),
                                'table-type' => $type,
                            ]) }}
                        </td>
                    @else
                        <td>{{ trans('generate.status.finish') }}</td>
                        @if (!$user->status)
                            <td>
                                {{ Form::button(trans('compoment.action.active'), [
                                    'class' => 'form-control',
                                    'id' => 'bt-active',
                                    'table-type' => $type,
                                    'data-url' => action('Admin\UserController@changeStatus',
                                        [$user->id,
                                        config('users.status.active')]),
                                ]) }}
                            </td>
                            <td>
                                {!! Form::checkbox(($user->status) ?
                                    'checkbox-user-active[]' : 'checkbox-user-block[]',
                                    $user->id,
                                    '', [
                                        'data-toggle' => 'checkbox',
                                        'id-user[]' => $user->id,
                                        'class' => 'bt-form',
                                ]) !!}
                            </td>
                        @else
                            <td></td>
                        @endif
                        <td></td>
                    @endif
                @endif
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

