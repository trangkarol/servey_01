@extends('clients.profile.layout')

@section('content-profile')
    @include('clients.profile.notice')
    <!-- show list feedback -->
    <div class="container ui-block padding-profile div-list-survey">
        <div class="ui-block-content">
            @include('clients.feedback.search')

            <div class="table-responsive" id="show-list-surveys">
                @include('clients.feedback.list_feedback')
            </div>
        </div>
    </div>
    @include('clients.feedback.detail')
@endsection

@push('scripts')
    {!! Html::script(elixir(config('settings.public_template') . 'js/survey.js')) !!}
@endpush
