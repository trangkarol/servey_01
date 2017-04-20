$(document).ready(function() {
    var error = $('.data').attr('data-error');
    var notice = $('.data').attr('data-confirm');
    var email_confirm = $('.data').attr('data-email-invalid');
    var formatDate = $('.data').attr('data-format-datetime');

    function validateEmail(email) {
        var re = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        return re.test(email);
    }

    function validateTailmail(email) {
        var text = /^@[A-Z0-9-]+(\.+([A-Z]+)){1,4}$/i;

        return text.test(email);
    }

    $("#survey_container").wizard({
        stepsWrapper: "#middle-wizard",
        beforeForward: function( event, state ) {
            if ( state.stepIndex === 1 ) {
                var today = new Date();
                var dateChoose = $('.frm-deadline').val();

                if (formatDate == 'DD-MM-YYYY hh:mm A') {
                    dateChoose = dateChoose.split('-')[1] + '-' + dateChoose.split('-')[0] + dateChoose.substring(5);
                }

                var dealineTime = new Date(Date.parse(dateChoose));
                var validateTime = dealineTime.getTime() - today.getTime();

                if ( dealineTime.length != 0 && validateTime < 1800000) {
                    $('.validate-time').css('display', 'block');

                    return false;
                }
            } else if ( state.stepIndex === 2 ) {
                $('html, body').animate({scrollTop: 0}, 500);

                if($('.data').attr('data-question') == 0) {
                    $('.create-question-validate')
                        .css('display', 'block')
                        .removeClass('fadeOutUp')
                        .addClass('animated fadeInDown');

                    return false;
                }
            } else if ( state.stepIndex === 3 ) {
                    $('html, body').animate({scrollTop: 0}, 1000);
                    var flag = temp = true;
                    var c1 = $('#requirement-answer').is(':checked');
                    var c2 = $('.option-choose-answer').is(':checked');
                    var c3 = $('#limit-answer').is(':checked');
                    var c4 = $('.quantity-limit').val();
                    var c5 = c4 % 1;
                    var c6 = $('#require-tail-email').is(':checked');
                    var c7 = $('.frm-tailmail').val();
                    var tailMails = $('.frm-tailmail').tagsinput('items');

                    tailMails.forEach(function (tailemail) {

                        if (!validateTailmail(tailemail)) {
                            temp = false;
                        }
                    });

                    if ((c1 && !c2) ){
                        $('.validate-requirement-answer')
                            .css('display', 'block')
                            .addClass('animated fadeInDown')
                            .delay(3000)
                            .slideUp(1000);
                        flag = false;
                    }

                    if ((c3 && !c4.length) || (c3 && c4.length && (c5 || parseInt(c4) < 1))) {
                        $('.validate-limit-answer')
                            .css('display', 'block')
                            .addClass('animated fadeInDown')
                            .delay(3000)
                            .slideUp(1000);
                        flag = false;
                    }

                    if ((c6 && !c7.length) || (c6 && c7.length && !temp)) {
                        $('.validate-tailmail')
                            .css('display', 'block')
                            .addClass('animated fadeInDown')
                            .delay(3000)
                            .slideUp(1000);
                        flag = false;
                    }

                    return flag;

                } else if ( state.stepIndex === 4 ) {
                    var emails = $('input:text[name=emails]').tagsinput('items');
                    var flag = true;
                    emails.forEach(function (email) {

                        if (!validateEmail(email)) {
                            flag = false;
                        }
                    });

                    if (emails.length != 0 && !flag) {
                        $('.validate-email').css('display', 'block')

                        return false;
                    }

                    $('.validate-email').css('display', 'none');
            }
        }
    });

    $(document).on('click', '.btn-save-setting', function() {
        var flag = temp = true;
        var c1 = $('#requirement-answer').is(':checked');
        var c2 = $('.option-choose-answer').is(':checked');
        var c3 = $('#limit-answer').is(':checked');
        var c4 = $('.quantity-limit').val();
        var c5 = c4 % 1;
        var c6 = $('#require-tail-email').is(':checked');
        var c7 = $('.frm-tailmail').val();
        var tailMails = $('.frm-tailmail').tagsinput('items');

        tailMails.forEach(function (tailemail) {

            if (!validateTailmail(tailemail)) {
                temp = false;
            }
        });

        if ((c1 && !c2) ){
            $('.validate-requirement-answer')
                .css('display', 'block')
                .addClass('animated fadeInDown')
                .delay(3000)
                .slideUp(1000);
            flag = false;
        }

        if ((c3 && !c4.length) || (c3 && c4.length && (c5 || parseInt(c4) < 1))) {
            $('.validate-limit-answer')
                .css('display', 'block')
                .addClass('animated fadeInDown')
                .delay(3000)
                .slideUp(1000);
            flag = false;
        }

        if ((c6 && !c7.length) || (c6 && c7.length && !temp)) {
            $('.validate-tailmail')
                .css('display', 'block')
                .addClass('animated fadeInDown')
                .delay(3000)
                .slideUp(1000);
            flag = false;
        }

        return flag;
    });

    $(document).on('click', '.btn-close-popup', function() {
        $('.popupBackground').fadeOut(500);
        $('.link-share').html('');
        $('.share-facebook').attr('data-href', '');
        setTimeout(function() {
            $('.popupBackground').css('display', 'none');
        }, 500);
    });

    $(document).on('click', '.image-type-option', function() {
        $('.create-question-validate')
            .removeClass('fadeInDown')
            .addClass('fadeOutUp');
        $('.create-question-validate').slideUp();
        setTimeout(function() {
            $('.create-question-validate').slideUp().css('display', 'none');
        }, 1000);
    });

    $(document).on('click', '.btn-send-mail', function() {
        var emails = $('.frm-mail-user').tagsinput('items');
        var input_email = $('.input-email').val();
        var flag = true;

        emails.forEach(function (email) {

            if (!validateEmail(email)) {
                flag = false;
            }
        });

        if ((emails.length != 0 && !flag)
            || !emails.length
            || !input_email.length
            || !validateEmail(input_email)
            ) {
            $('.validate-send-email').css('display', 'block');

            setTimeout(function() {
                $('.validate-send-email').slideUp(1000);
            }, 4000);

            return false;
        }

        return true;
    });

    $(document).on('click', '.submit-survey', function() {
        if(!$('.quantity-limit').val().length) {
            $('.setting-limit').remove();
        }
    });

    $('#tab-save-info').on('click', '.btn-save-survey', function() {
        var _tempTitle = $('.frm-title');

        return (!_tempTitle['length'] || _tempTitle['valid']());
    });
});
