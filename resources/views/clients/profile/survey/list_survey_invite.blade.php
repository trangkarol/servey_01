@if ($surveys->isNotEmpty())
    <table class="table table-bordered table-list-survey">
        <thead>
            <tr>
                <th class="text-center">@lang('profile.index')</th>
                <th width="25%" class="text-center">@lang('profile.name_survey')</th>
                <th class="text-center">@lang('profile.status')</th>
                <th class="text-center">@lang('survey.remaining_time')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveys as $survey) 
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('survey.create.do-survey', $survey->token) }}" target="_blank" data-toggle="tooltip" title="{{ $survey->title }}">{{ $survey->trim_title }}</a>
                    </td>
                    <td>
                        @php
                            $invites = $survey->invite->invite_mails_array;
                        @endphp
                        <span class="badge badge-info badge-list-survey">
                            {{ in_array(Auth::user()->email, $invites) ? trans('profile.not_finished') : trans('profile.finished') }}
                        </span>
                        <span class="badge badge-secondary badge-list-survey">{{ $survey->status_custom }}</span>
                    </td>
                    <td>
                        <span class="badge badge-info badge-list-survey">{{ $survey->remaining_time ? $survey->remaining_time : '' }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="url_onwer" value="{{ route('ajax-list-survey', config('settings.survey.members.owner')) }}" class="url_onwer">

    {{ $surveys->links('clients.layout.pagination') }}
@else
    @include('clients.layout.empty_data')
@endif
@include('clients.profile.survey.inviting_status')
