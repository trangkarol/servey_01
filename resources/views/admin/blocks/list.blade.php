<div class="content table-responsive table-full-width" id="table">
    <table class="table table-hover table-striped">
        <thead>
            <th>{{ trans('generate.id') }}</th>
            <th>{{ trans('generate.title') }}</th>
            <th>{{ trans('generate.email') }}</th>
            <th>{{ trans('generate.feature.generate') }}</th>
            <th>{{ trans('generate.chocies') }}</th>
            <th>{{ trans('generate.remove') }}</th>
        </thead>
        @foreach ($surveys as $survey)
        <tbody class="sva{{ $survey->id }}">
            <tr>
                <td>{{ $survey->id }}</td>
                <td>{{ $survey->title }}</td>
                <td>{{ $survey->user->email }}</td>
                <td>
                    {{ ($survey->feature == config('settings.feature')) ? trans('generate.feature.yes_feature') : trans('generate.feature.not_feature') }}
                </td>
                <td>
                    {!! Form::checkbox(($survey->feature == config('settings.feature')) ?
                        'checkbox-survey-change[]' : 'checkbox-survey-update[]',
                        $survey->id,
                        '', [
                            'data-toggle' => 'checkbox',
                            'id-survey[]' => $survey->id,
                            'class' => 'bt-form',
                        ])
                    !!}
                </td>
                <td>
                    {!! Form::button('<i class="fa fa-remove"></i>', [
                        'class' => 'btn btn-info btn-simple btn-xs remove-sva',
                        'title' => trans('admin.remove'),
                        'rel' => 'tooltip',
                        'id-survey' => $survey->id
                    ]) !!}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
