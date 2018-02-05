<div id="question-{{ $question->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title header-answer">{!! $question->content !!}</h4>
          </div>
           <div class="modal-body">
                <table class="table table-bordered detail-answer">
                    <thead class="thead-default">
                        <tr>
                            <th>{{ trans('survey.index') }}</th>
                            <th>{{ trans('survey.question') }}</th>
                            <th>{{ trans('survey.quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($question->answers as $answer)
                            @if ($answer->update >= 0 && in_array($answer->type, [
                                config('survey.type_radio'),
                                config('survey.type_checkbox'),
                                config('survey.type_other_radio'),
                                config('survey.type_other_checkbox'),
                            ]))
                                <tr>
                                    <td class="text-center">{{ $loop->parent->iteration . '.' . $loop->iteration }}</td>
                                    <td><div>{!! $answer->content !!}</div></td>
                                    <td class="text-center">{{ count($answer->results) }}</td>
                                </tr>
                            @elseif ($answer->type != config('survey.type_radio')
                                && $answer->type != config('survey.type_checkbox'))
                                @foreach ($answer->results as $result)
                                    <tr>
                                        <td class="text-center"> - </td>
                                        <td>{!! $result->content !!}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('survey.close') }}</button>
            </div>
        </div>
    </div>
</div>
