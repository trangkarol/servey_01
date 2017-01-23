<div class="content table-responsive table-full-width" id="table">
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
                <td>{!! Html::image($user->image, 'userAvatar', ['class' => 'avatar border-gray']) !!}</td>
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
                <td>{{ ($user->status) ? trans('generate.status.active') : trans('generate.status.block') }}</td>
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
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
