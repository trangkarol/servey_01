@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('generate.view.detail', ['object' => class_base_name(Survey::class)]) }}
                </div>
                <div class="panel-body">
                    {{ trans('generate.view.chart') }}
                </div>
                @if (!$status)
                    <dir class="alert alert-info">
                        <p>{{ trans('messages.object_not_have', ['object' => class_basename(Result::class)]) }}</p>
                    </dir>
                @else
                <div class="ct-data" data-number="{{ count($charts) }}" data-content="{{ json_encode($charts) }}">
                    @foreach ($charts as $key => $value)
                        <div id="container{{ $key }}"></div>
                            @if (!is_string($value['chart'][0]['answer']))
                                {{ $value['question']->content }}
                                <div class="panel-body">
                                    @foreach ($value['chart'][0]['answer'] as $keyCollection => $collection)
                                        <p>
                                          {{ $collection->content }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
