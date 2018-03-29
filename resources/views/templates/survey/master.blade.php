@include('templates.survey.header')
<div class="main-content">
    @yield('content')
</div>
@include('templates.user.auth.register')
@include('templates.user.auth.login')
@include('templates.user.auth.forgot-password')
@include('templates.survey.footer')
