<div class="show-chart inner">
   @if (!$status)
        <div class="alert alert-info">
            <p>{{ trans('temp.dont_have_result') }}</p>
        </div>
    @else
        <div class="ct-data"
            data-number="{{ count($charts) }}"
            data-content="{{ json_encode($charts) }}">
            @foreach ($charts as $chart)
                <div class="container-text-question">
                    <h4>{{ $loop->iteration }} {{ '. ' }} {{ $chart['question']->content }}</h4>
                    <div class="container-chart" id="container{{ $loop->index }}">
                    </div>
                    @if (!is_string($chart['chart'][0]['answer']))
                        <div class="content-chart">
                            @foreach ($chart['chart'][0]['answer'] as $collection)
                                <div>
                                    <h5>{{ !is_array($collection) ? ' -  ' . $collection->content : $collection['content'] }} </h5>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
