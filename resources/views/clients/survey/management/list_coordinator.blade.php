<table class="table table-bordered table-list-survey">
    <thead>
        <tr>
            <th class="text-center">@lang('profile.index')</th>
            <th class="text-center">@lang('survey.members')</th>
            <th class="text-center">@lang('survey.role')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php
            $members = $survey->getListMembers();
        @endphp

        @foreach ($members as $member) 
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <div class="author-page author vcard inline-items more">
                        <div class="author-thumb image-coordinator">
                            <img src="{{ $member->image }}" class="avatar">
                        </div>
                        <a href="02-ProfilePage.html" class="author-name fn">
                            <div class="author-title name-coordinator">{{ $member->name }}</div>
                            <span class="author-subtitle mail-coordinator">{{ $member->email }}</span>
                        </a>
                    </div>
                </td>
                <td>
                    @if ($member->id != Auth::user()->id)
                        {{ Form::select('role', [ config('settings.survey.members.owner') => trans('survey.owner'), config('settings.survey.members.editor') => trans('survey.coordinator')], $member->pivot->role, ['class' => 'select-list-survey']) }}
                    @else
                        @lang('survey.owner')
                    @endif
                </td>
                <td>
                    @if ($member->id != Auth::user()->id)
                        <a href="" class="btn btn-dark">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $members->links() !!}
