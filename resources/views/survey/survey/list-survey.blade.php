@extends('survey.profile.layout')

@section('content-profile')
    <a href="#tag-link-table-survey" id="auto-focus-table"></a>
    <div class="container padding-profile" id="tag-link-table-survey">
        <div class="row">
            <div class="col-xl-12 push-xl-12 col-lg-12 push-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="ui-block">
                    <div class="ui-block-content table-custom-survey">
                        <table id="list-survey" class="stripe display hover cell-border"
                            width="100%" cellspacing="0"
                            data-url="{{ route('survey.survey.get-surveys') }}">
                            <thead>
                                <tr>
                                    <tr>
                                        <th width="5%">@lang('lang.index')</th>
                                        <th>@lang('lang.name_survey')</th>
                                        <th>@lang('lang.status')</th>
                                        <th id="share-language" share="@lang('lang.share')">@lang('lang.share')</th>
                                        <th>@lang('lang.date_created')</th>
                                    </tr>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
