@extends('user.master')
@section('content')
    <div class="content-question container">
        <div class="title-survey">
            <h1>{{ $surveys->title }}</h1>
        </div>
        {{ Form::open([
            'action' => ['User\ResultController@result', $surveys->token],
            'method' => 'POST',
        ]) }}
            @foreach ($surveys->questions as $key => $question)
                <div class="row-container-answer">
                    <div>
                        <p class="qs-content">
                            {{ ++$key }} . {{ $question->content }}
                        </p>
                    </div>
                    <div class="put-answer">
                         @foreach ($question->answers as $temp => $answer)
                            @switch($answer->type)
                                @case(config('survey.type_radio'))
                                    <div class="12u$(small) ct-option">
                                        {{ Form::radio("answer[$question->id]", $answer->id, '', [
                                            'id' => "$key-$temp",
                                            'class' => 'option-choose',
                                            'temp-as' => $answer->id,
                                            'temp-qs' => $question->id,
                                        ]) }}
                                        <label for="{{ $key }}-{{ $temp }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                    @breakswitch
                                @case(config('survey.type_checkbox'))
                                    <div class="12u$(small) ct-option">
                                        {{ Form::checkbox("answer[$question->id][$answer->id]", $answer->id, '', [
                                            'id' => "$key-$temp",
                                        ]) }}
                                        <label for="{{ $key }}-{{ $temp }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                    @breakswitch
                                @case(config('survey.type_short'))
                                    <div class="put-answer">
                                        {!! Form::text("answer[$question->id][$answer->id]", '', [
                                            'class' => 'short-text',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    @breakswitch
                                @case(config('survey.type_long'))
                                    <div class="put-answer">
                                        {!! Form::textarea("answer[$question->id][$answer->id]", '', [
                                            'class' => 'long-text',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    @breakswitch
                                @case(config('survey.type_other_radio'))
                                    <div class="container-other row">
                                        <div class="col-md-2">
                                            <div class="12u$(small) ct-option">
                                                {{ Form::radio("answer[$question->id]", $answer->id, '', [
                                                    'id' => "$key-$temp",
                                                    'class' => 'option-add',
                                                    'temp-as' => $answer->id,
                                                    'temp-qs' => $question->id,
                                                    'url' => action('SurveyController@textOther'),
                                                ]) }}
                                                <label for="{{ $key }}-{{ $temp }}">
                                                    {{ trans('home.other') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-5 append-as{{ $question->id }}"></div>
                                    </div>
                                    @breakswitch
                                @case(config('survey.type_other_checkbox'))
                                    <div class="container-other row">
                                        <div class="col-md-2">
                                            <div class="12u$(small) ct-option">
                                                {{ Form::checkbox("answer[$question->id]", $answer->id, '', [
                                                    'id' => "$key-$temp",
                                                    'class' => 'option-add',
                                                    'temp-as' => $answer->id,
                                                    'temp-qs' => $question->id,
                                                    'url' => action('SurveyController@textOther'),
                                                ]) }}
                                                <label for="{{ $key }}-{{ $temp }}">
                                                    {{ trans('home.other') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-5 append-as{{ $question->id }}"></div>
                                    </div>
                                    @breakswitch
                            @endswitch
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="div-submit">
                {{ Form::submit(trans('home.submit')) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection
