<div class="row">
    {!! Form::open([
        'class' => 'form-search-list-survey col-xl-12 push-xl-12 col-lg-12 push-lg-12 col-md-12 col-sm-12 col-xs-12']) !!}
        <div class="col-xl-3 push-xl-3 col-lg-3 push-lg-3 col-md-3 col-sm-3 col-xs-3">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('survey.name_survey')]) !!}
        </div>
        <div class="col-xl-3 push-xl-3 col-lg-3 push-lg-3 col-md-3 col-sm-3 col-xs-3">
            {!! Form::select('status', [
                config('settings.survey.status.open') => trans('profile.open'),
                config('settings.survey.status.close') => trans('profile.closed'),
                config('settings.survey.status.draft') => trans('profile.draft'),
            ], null, ['class' => 'select-list-survey', 'placeholder' => trans('survey.status')]) !!}
        </div>
        <div class="col-xl-3 push-xl-3 col-lg-3 push-lg-3 col-md-3 col-sm-3 col-xs-3">
            {!! Form::select('privacy', [
                config('settings.survey_setting.privacy.public') => trans('profile.public'),
                config('settings.survey_setting.privacy.private') => trans('profile.private'),
            ], null, ['class' => 'select-list-survey', 'placeholder' => trans('survey.privacy')]) !!}
        </div>
        <div class="col-xl-3 push-xl-3 col-lg-3 push-lg-3 col-md-3 col-sm-3 col-xs-3 btn-search-owner">
            <a href="javascript:void(0)" 
                class="btn btn-info btn-search-survey" 
                data-toggle="tooltip" 
                title="@lang('survey.search')"
                data-url="{{ route('ajax-list-survey', config('settings.survey.members.owner')) }}">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
        </div>
    {!! Form::close() !!}
</div>
