$(document).ready(function() {
    var requiredLogin = $('#login').data('required-login');

    if (requiredLogin == 1) {
        alertDanger(
            {
                message: Lang.get('lang.require_login_to_answer'),
                closeOnClickOutside: false,
                closeOnEsc: false,
            },
            function () {
                $('#modalLogin').modal({
                    backdrop: 'static',
                    keyboard: false
                })

                $('.close.btn-close-form').hide();
                $('#login').click();
            }
        );
    } else if (requiredLogin == 2) {
        alertDanger(
            {
                message: Lang.get('lang.require_login_wsm_to_answer'),                
                closeOnClickOutside: false,
                closeOnEsc: false,
            },
            function () {
                window.location = $('#login').data('login-wsm');
            }
        );
    }
});
