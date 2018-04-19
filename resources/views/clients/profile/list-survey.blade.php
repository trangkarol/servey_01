@extends('clients.profile.layout')

@section('content-profile')
    @include('clients.profile.notice')
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
                                        <th width="5%">@lang('profile.index')</th>
                                        <th width="40%">@lang('profile.name_survey')</th>
                                        <th width="15%">@lang('profile.status')</th>
                                        <th width="10%" id="send-survey" data="@lang('profile.send')">@lang('profile.send')</th>
                                        <th width="15%" id="share-language" share="@lang('profile.share')"
                                            data-url="">@lang('profile.share')</th>
                                        <th width="15%">@lang('profile.date_created')</th>
                                    </tr>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pupup-send-survey">
        <div class="modal-dialog ui-block window-popup modal-dialog-send-survey">
            <a href="#" class="close icon-close" data-dismiss="modal">
                <span><i class="fa fa-times"></i></span>
            </a>

            <div class="ui-block-title">
                <h6 class="title"><i class="fa fa-share-alt"></i> @lang('profile.share')</h6>
            </div>
            <div class="ui-block-content-custom">
                <div class="share-survey-wrrapper">
                    <span class="title-share-survey"><i class="fa fa-link"></i> @lang('profile.shareable_link')</span>
                    <div class="share-survey-content share-survey-content-share">
                        <span>@lang('profile.use_this_link_to_share_with_people')</span>
                        <button onclick="copyLink()" class="btn-copy-link">
                            <i class="fa fa-copy"></i> @lang('profile.copy_link')
                        </button>
                        <p class="link-share" id="link-share"></p>
                    </div>
                </div>
                <div class="share-survey-wrrapper">
                    <span class="title-share-survey"><i class="fa fa-envelope-o"> @lang('profile.send_mail')</i></span>
                    {!! Form::open() !!}
                        <div class="share-survey-content">
                            <div class="col-md-12">
                                {!! Form::email('email', $user->email, ['disabled', 'class' => 'form-control']) !!}
                            </div>
                            <div class="list-mail-content">
                                <div class="col-md-12 div-show-all-email"></div>
                                <div class="col-md-12">
                                    {!! Form::email('email', '', ['placeholder' => trans('profile.enter_mail_placeholder'),
                                        'class' => 'form-control type-email-send']) !!}
                                </div>
                            </div>
                            <div class="btn-action-content row">
                                <div class="col-md-6">
                                    {!! Form::button(trans('profile.send'), ['class' => 'btn-action-pupup', 'id' => 'btn-submit-send-mail']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::button(trans('profile.exit'), ['class' => 'btn-action-pupup exit', 'data-dismiss' => 'modal']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
