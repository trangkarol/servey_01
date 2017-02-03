@extends('user.master')
@section('content')
    <div class="content-question container">
        <div class="title-survey">
            <h1>{{ $surveys->title }}</h1>
        </div>
        {{ Form::open(['action' => 'User\ResultController@result']) }}
            @foreach ($surveys->questions as $key => $question)
                <div class="row-container-answer">
                    <div>
                        <p class="qs-content">
                            {{ ++$key }}. {{ $question->content }}
                        </p>
                    </div>
                    <div class="put-answer">
                         @foreach ($question->answers as $temp => $answer)
                            @switch ($answer->type)
                                @case (config('survey.type_radio'))
                                    <div class="12u$(small) ct-option">
                                        {{ Form::radio("answer[$question->id]", $answer->id, '', [
                                            'id' => "$key-$temp",
                                        ]) }}
                                        <label for="{{ $key }}-{{ $temp }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                    @breakswitch
                                @case (config('survey.type_checkbox'))
                                    <div class="12u$(small) ct-option">
                                        {{ Form::checkbox("answer[$question->id]", $answer->id, '', [
                                            'id' => "$key-$temp",
                                        ]) }}
                                        <label for="{{ $key }}-{{ $temp }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                    @breakswitch
                                @case (config('survey.type_short'))
                                    <div class="put-answer">
                                        {!! Form::text("answer[$question->id]", '', [
                                            'class' => 'short-text',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    @breakswitch
                                @case (config('survey.type_long'))
                                    <div class="put-answer">
                                        {!! Form::textarea("answer[$question->id]", '', [
                                            'class' => 'long-text',
                                            'required' => true,
                                        ]) !!}
                                    </div>
                                    @breakswitch
                                @case (config('survey.type_other_radio'))
                                    <div class="container-other row">
                                        <div>
                                            <div>
                                                <span>{{ trans('home.other') }}</span>
                                            </div>
                                            <div>
                                                {!! Form::text("answer[$question->id][$answer->id]",'', [
                                                    'class' => 'input-radio', 'required' => true,
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @breakswitch
                                @case (config('survey.type_other_checkbox'))
                                    <div class="container-other row">
                                        <div>
                                            <div>
                                                <span>{{ trans('home.other') }}</span>
                                            </div>
                                            <div>
                                                {!! Form::text("answer[$question->id][$answer->id]", '', [
                                                    'class' => 'input-checkbox',
                                                ]) !!}
                                            </div>
                                        </div>
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
