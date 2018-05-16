@if ($surveys->isNotEmpty())
    <table class="table table-bordered table-list-survey">
        <thead>
            <tr>
                <th class="text-center">@lang('profile.index')</th>
                <th width="25%" class="text-center">@lang('profile.name_survey')</th>
                <th class="text-center">@lang('profile.status')</th>
                <th class="text-center">@lang('survey.inviting')</th>
                <th class="text-center">@lang('survey.remaining_time')</th>
                <th width="16%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveys as $survey) 
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('survey.create.do-survey', $survey->token) }}" data-toggle="tooltip" title="{{ $survey->title }}">{{ $survey->trim_title }}</a>
                    </td>
                    <td>
                        <span class="badge badge-info badge-list-survey">{{ $survey->settings->first()->value == config('settings.survey_setting.privacy.public') ? trans('profile.public') :  trans('profile.private') }}</span>
                        <span class="badge badge-secondary badge-list-survey">{{ $survey->status_custom }}</span>
                    </td>
                    <td>
                        @php
                            $invites = $survey->getInvites();
                        @endphp
                        
                        <div class="progress process-bar-survey">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="{{ $survey->getInvites() }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $invites }}%">{{ $invites }}%</div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-info badge-list-survey">{{ $survey->remaining_time ? $survey->remaining_time . trans('survey.remaining_date') : '' }}</span>
                       <!--  {{ $survey->remaining_time ? $survey->remaining_time . trans('survey.remaining_date') : '' }} -->
                    </td>
                    <td>
                        <a href="{{ route('survey.management', $survey->token_manage) }}" class="btn btn-info" data-toggle="tooltip" title="Setting">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
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
