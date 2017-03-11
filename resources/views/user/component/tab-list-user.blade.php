<table class="table table">
    <thead class="thead-default">
        <tr>
            <th>
                {{ trans('user.name') }}
            </th>
            <th>
                {{ trans('user.email') }}
            </th>
            <th>
                {{ trans('user.date') }}
            </th>
            <th>
                {{ trans('user.detail') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listUserAnswer as $user)
            <tr>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->created_at }}
                </td>
                <td>
                    <a href=""></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

