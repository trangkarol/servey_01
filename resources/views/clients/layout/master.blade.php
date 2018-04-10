@include('clients.layout.header')
<div class="main-content">
    @yield('content')
</div>
@include('clients.user.auth.register')
@include('clients.user.auth.login')
@include('clients.user.auth.forgot-password')
@include('clients.layout.footer')
