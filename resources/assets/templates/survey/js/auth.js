$(document).ready(function () {
    $(document).on('submit', '#formLogin', function (e) {
        e.preventDefault();
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        })
        .done(function (data) {
            if (data) {
                location.reload();
            } else {
                $('.login-messages').text(Lang.get('auth.failed'));
                $('input[type=password]').val('');
            }
        })
        .fail(function (data) {
            $('.login-messages').text(Lang.get('auth.failed'));
            $('input[type=password]').val('');
        });
    });

    $(document).on('submit', '#formRegister', function (e) {
        e.preventDefault();
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        })
        .done(function (data) {
            if (data) {
                location.reload();
            }
        })
        .fail(function (data) {
            var errors = JSON.parse(data.responseText);
            $('.name-messages').text(errors.name);
            $('.email-messages').text(errors.email);
            $('.password-messages').text(errors.password);
            $('input[type=password]').val('');
        });
    });
});
