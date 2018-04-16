$(document).ready(function() {
    var locale = $('#datepicker-preview').attr('locale');

    $('#datepicker-preview').datetimepicker({
        format: getTimeZone(locale),
    });

    $('#timepicker-preview').datetimepicker({
        format: 'HH:mm',
    });

    //event click img answer

    $('.img-checkbox-preview').click(function() {
        var selector = $(this).next('label').children('input');

        if (selector.prop('checked')) {
            $(selector).prop('checked', false);
            $(this).css('border', 'none');
        } else {
            $(selector).prop('checked', true);
            $(this).css('border', '2px solid #43add1');
        }
    });

    $('.img-radio-preview').click(function() {
        var selector = $(this).next('label').children('input');

        if (!selector.prop('checked')) {
            $(selector).prop('checked', true);
            $(this).css('border', '2px solid #43add1');
        }

        //turn off radio others

        $('.radio-answer-preview').each(function () {
            if (!$(this).prop('checked')) {
                var selector = $(this).parent('.container-radio-setting-survey')
                    .prev('.img-preview-answer-survey');

                if ($(selector).length) {
                    $(selector).css('border', 'none');
                }
            }
        })
    });

    $('.checkbox-answer-preview').change(function() {
        var selector = $(this).parent('.container-checkbox-setting-survey')
            .prev('.img-preview-answer-survey');

        if ($(selector).length) {
            if ($(this).prop('checked')) {
                $(selector).css('border', '2px solid #43add1');
            } else {
                $(selector).css('border', 'none');
            }
        }
    });

    $('.radio-answer-preview').change(function() {
        if ($(this).prop('checked')) {
            var selector = $(this).parent('.container-radio-setting-survey')
                .prev('.img-preview-answer-survey');

            if ($(selector).length) {
                $(selector).css('border', '2px solid #43add1');
            }
        }

        //turn off radio others
        
        $('.radio-answer-preview').each(function () {
            if (!$(this).prop('checked')) {
                var selector = $(this).parent('.container-radio-setting-survey')
                    .prev('.img-preview-answer-survey');

                if ($(selector).length) {
                    $(selector).css('border', 'none');
                }
            }
        })
    });
});

function getTimeZone(locale) {
    if (locale === 'vn') {
        return 'DD-MM-YYYY';
    }

    if (locale === 'jp') {
        return 'YYYY-MM-DD';
    }

    return 'MM-DD-YYYY';
}
