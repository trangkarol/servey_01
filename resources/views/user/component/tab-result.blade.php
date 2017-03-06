<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div class="show-chart inner">
           @if (!$status)
                <div class="alert alert-info">
                    <p>{{ trans('temp.dont_have_result') }}</p>
                </div>
            @else
                <div class="ct-data"
                    data-number="{{ count($charts) }}"
                    data-content="{{ json_encode($charts) }}">
                    @foreach ($charts as $key => $value)
                        <div id="container{{ $key }}" class="container-chart"></div>
                        @if (!is_string($value['chart'][0]['answer']))
                            <div class="container-text-question">
                                <div class="question-chart">
                                    <h4>{{ ($key + 1) . $value['question']->content }}</h4>
                                </div>
                                <div class="content-chart">
                                    @foreach ($value['chart'][0]['answer'] as $collection)
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
    </div>
    <div id="menu1" class="tab-pane fade">
        <table class="table-result table">
            <thead class="thead-default">
                <tr>
                    <th>
                        {{ trans('survey.index') }}
                    </th>
                    <th>
                        {{ trans('survey.question_type') }}
                    </th>
                    <th>
                        {{ trans('survey.question') }}
                    </th>
                    <th>
                        {{ trans('survey.answerIndex') }}
                    </th>
                    <th>
                        {{ trans('survey.answer') }}
                    </th>
                    <th>
                        {{ trans('survey.quatily') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($survey->questions as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>
                        @switch($value->answers[0]->type)
                            @case(config('survey.type_radio'))
                                {{ trans('temp.one_choose') }}
                                @breakswitch
                            @case(config('survey.type_checkbox'))
                                {{ trans('temp.multi_choose') }}
                                @breakswitch
                            @case(config('survey.type_text'))
                                {{ trans('temp.text') }}
                                @breakswitch
                            @case(config('survey.type_date'))
                                {{ trans('temp.date') }}
                                @breakswitch
                            @case(config('survey.type_time'))
                                {{ trans('temp.time') }}
                                @breakswitch
                        @endswitch
                        </td>
                        <td>{{ $value->content }}</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>
                    @foreach ($value->answers as $keyAnswer => $answer)
                        @if (in_array($answer->type, [
                            config('survey.type_radio'),
                            config('survey.type_checkbox'),
                            config('survey.type_other_radio'),
                            config('survey.type_other_checkbox'),
                        ]))
                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>{{ $key . '.' . ++$keyAnswer }}</td>
                                <td>{{ $answer->content }}</td>
                                <td>{{ count($answer->results) }}</td>
                            </tr>
                        @elseif ($answer->type != config('survey.type_radio')
                            && $answer->type != config('survey.type_checkbox'))
                            @foreach ($answer->results as $result)
                                <tr>
                                    <td>&nbsp</td>
                                    <td>&nbsp</td>
                                    <td>&nbsp</td>
                                    <td> - </td>
                                    <td>{{ $result->content }}</td>
                                    <td>&nbsp</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($listUserAnswer)
        <div id="menu3" class="tab-pane fade">
            @include('user.component.tab-list-user')
        </div>
    @endif
    @if ($history)
        <div id="menu2" class="tab-pane fade">
            @include('user.component.tab-history')
        </div>
    @endif
</div>
