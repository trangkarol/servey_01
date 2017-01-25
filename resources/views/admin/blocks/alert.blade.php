<div class="alert-message">
    @if (Session::get('message-success'))
        <div class="alert alert-success">
            <span>
                <p>
                    {{ Session::get('message-success') }}
                </p>
            </span>
        </div>
    @elseif (Session::get('message-fail'))
        <div class="alert alert-warning">
            <span>
                <p>
                    {{ Session::get('message-fail') }}
                </p>
            </span>
        </div>
    @endif
</div>
