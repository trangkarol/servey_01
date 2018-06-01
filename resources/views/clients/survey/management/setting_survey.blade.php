<main class="cd-main-content">
    @include('clients.profile.notice')
    <div class="content-wrapper">
        <!-- /Scroll buttons -->
        <div class="offset-md-9">
            <a href="javascript:void(0)" class="btn btn-danger" id="delete-survey"
                data-toggle="tooltip" title="@lang('survey.delete')"
                data-url="{{ route('ajax-survey-delete', $survey->token_manage) }}">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
            <a href="{{ route('surveys.edit', $survey->token_manage) }}" class="btn btn-info"
                data-toggle="tooltip" title="@lang('survey.edit')">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>

            <a href="javascript:void(0)" class="btn {{ $survey->isClose() ? 'hide-div' : '' }}" 
                id="close-survey"
                data-toggle="tooltip" title="@lang('survey.close')"
                data-url="{{ route('ajax-survey-close', $survey->token_manage) }}">
                <i class="fa fa-lock" aria-hidden="true" style="color: #333;"></i>
            </a>

            <a href="javascript:void(0)" class="btn btn-warning {{ $survey->isOpen() ? 'hide-div' : '' }}" 
                id="open-survey"
                data-toggle="tooltip" title="@lang('survey.open')"
                data-url="{{ route('ajax-survey-open', $survey->token_manage) }}">
                <i class="fa fa-unlock" aria-hidden="true"></i>
            </a>

            <a href="javascript:void(0)" class="btn btn-dark"
               data-toggle="tooltip" title="@lang('survey.coppy')">
                <i class="fa fa-copy"></i>
            </a>
        </div>
        @include('clients.survey.detail.detail_survey')
    </div>
    <!-- Content Wrapper  -->
</main>

