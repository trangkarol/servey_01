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
                <div id="container{{ $loop->index }}" class="container-chart"></div>
                @if (!is_string($chart['chart'][0]['answer']))
                    <div class="container-text-question">
                        <div class="question-chart">
                            <h4>{{ $loop->iteration }}. {{ $chart['question']->content }}</h4>
                        </div>
                        <div class="content-chart">
                            @foreach ($chart['chart'][0]['answer'] as $collection)
                                <div>
                                    <h5> - {{ $collection->content }} </h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
