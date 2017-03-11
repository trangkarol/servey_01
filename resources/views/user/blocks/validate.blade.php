@if (count($errors))
    <div class="alert alert-warning warning-login-register">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
