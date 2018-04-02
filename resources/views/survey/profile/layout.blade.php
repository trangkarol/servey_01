@extends ('templates.survey.master')

@push('styles')
    {!! Html::style(elixir(config('settings.public_template') . 'css/theme-styles.css')) !!}
    {!! Html::style(elixir(config('settings.public_template') . 'css/blocks.css')) !!}
    {!! Html::style(asset(config('settings.plugins') . 'datatables/jquery.dataTables.css')) !!}
@endpush

@section ('content')
    <div class="font-profile">
        @include('survey.profile.notice')
        <div class="container padding-profile background-container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="ui-block">
                        <div class="top-header">
                            <div class="top-header-thumb image-background-profile">
                                <img src="{{ asset(config('settings.top-background-profile')) }}" alt="nature">
                            </div>
                            <div class="profile-section">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 list-profile-menu">
                                        @if (Auth::user() == $user)
                                            <ul class="profile-menu">
                                                <li>
                                                    <a href="{{ route('survey.profile.index') }}"
                                                        class="{{ Session::get('page_profile_active') ==
                                                            config('settings.page_profile_active.information')
                                                            ? 'active' : '' }}">
                                                        @lang('lang.information')
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="" class="{{ Session::get('page_profile_active') ==
                                                            config('settings.page_profile_active.list_survey')
                                                            ? 'active' : '' }}">
                                                        @lang('lang.list_survey')
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="col-lg-5 offset-lg-2 col-md-5 offset-md-2 list-profile-menu">
                                        @if (Auth::user() == $user)
                                            <ul class="profile-menu">
                                                <li>
                                                    <a href="">@lang('lang.create_survey')</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                @if (Auth::user() == $user)
                                    <div class="control-block-button">
                                        <div class="btn btn-control btn-color-red more">
                                            <span class="icon-setting-profile"><i class="fa fa-sliders"></i></span>
                                            <ul class="more-dropdown more-with-triangle triangle-bottom-right">
                                                <li>
                                                    <a href="#" data-toggle="modal" data-target="#update-profile-photo">@lang('lang.update_profile_photo')</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('survey.profile.edit', $user->id) }}">@lang('lang.account_settings')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="top-header-author">
                                <a href="{{ route('survey.profile.show', $user->id) }}" class="author-thumb">
                                    {!! Html::image(asset($user->image), '', ['width' => '120', 'height' => '120']) !!}
                                </a>
                                <div class="author-content">
                                    <a href="{{ route('survey.profile.show', $user->id) }}" class="h4 author-name">{{ ucwords($user->name) }}</a>
                                    <div class="country">{{ ucwords($user->email) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield ('content-profile')

        <div class="modal fade" id="update-profile-photo">
            <div class="modal-dialog ui-block window-popup update-header-photo">
                <a href="#" class="close icon-close" data-dismiss="modal">
                    <span><i class="fa fa-times"></i></span>
                </a>

                <div class="ui-block-title">
                    <h6 class="title">@lang('lang.update_profile_photo')</h6>
                </div>

                {!! Form::open(['route' => ['survey.profile.changeavatar'], 'method' => 'post', 'files' => 'true']) !!}
                    <a href="#" id="change-avatar" class="upload-photo-item">
                        <span><i class="fa fa-desktop fa-3x"></i></span>
                        <h6>@lang('lang.upload_photo')</h6>
                        <span class="browse-your-computer">@lang('lang.browse_your_computer')</span>
                        <span class="name-picture-profile"></span>
                    </a>
                    <a href="{{ route('survey.profile.deleteavatar') }}" class="upload-photo-item" onclick="return confirm('@lang('lang.are_you_sure_want_to_delete')')">
                        <span><i class="fa fa-trash fa-3x"></i></span>
                        <h6>@lang('lang.delete_avatar')</h6>
                        <span>@lang('lang.use_the_default_avatar')</span>
                    </a>
                    {!! Form::file('image', ['id' => 'upload-avatar', 'class' => 'a']) !!}
                    {!! Form::submit(trans('lang.change'), ['class' => 'submit-image-profile']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
