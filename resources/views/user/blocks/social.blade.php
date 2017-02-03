<section>
    <h2>{{ trans('home.login_with') }}</h2>
    <ul class="icons">
        <li>
            <a href="{{ action('User\SocialAuthController@redirect', 'google') }}" class="icon style2 fa-google">
                <span class="label">{{ trans('home.google') }}</span>
            </a>
        </li>
    </ul>
</section>
