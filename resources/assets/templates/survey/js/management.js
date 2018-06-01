$(document).ready(function () {
    // get overview
    $(document).on('click', '#overview-survey', function () {
        var url = $(this).attr('data-url');
        handelManagement($(this));
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#div-management-survey').html(data.html).promise().done(function () {
                    getOverviewSurvey();// use to render chart of overview at line 4 of file /resources/assets/templates/survey/js/management-chart.js
                });
            }
        });
    });

    // get result
    $(document).on('click', '#results-survey', function () {
        var url = $(this).attr('data-url');
        handelManagement($(this));
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#div-management-survey').html(data.html).promise().done(function () {
                    results(); // use to render chart of result of survey at line 35 of file resources/assets/templates/survey/js/result.js
                    $(this).find('.ul-result').addClass('ul-result-management');
                });
            }
        });
    });

    // setting survey
    $(document).on('click', '#setting-survey', function () {
        var url = $(this).attr('data-url');
        handelManagement($(this));
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#div-management-survey').html(data.html).promise().done(function () {
                    results(); // use to render chart of result of survey at line 35 of file resources/assets/templates/survey/js/result.js
                    $(this).find('.ul-result').addClass('ul-result-management');
                });
            }
        });
    });

    // delete survey
    $(document).on('click', '#delete-survey', function () {
        var url = $(this).attr('data-url');
        confirmDanger({message: Lang.get('lang.comfirm_delete_survey')}, function () {
            $.ajax({
                method: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        window.location.replace(data.url_redirect);
                    }

                    alertDanger({message: data.message});
                }
            });
        });
    });

    // close survey survey
    $(document).on('click', '#close-survey', function () {
        var url = $(this).attr('data-url');
        confirmDanger({message: Lang.get('lang.comfirm_close_survey')}, function () {
            $.ajax({
                method: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#close-survey').addClass('hide-div');
                        $('#open-survey').removeClass('hide-div');
                        alertSuccess({message: data.message});
                    } else {
                        alertDanger({message: data.message});
                    }
                }
            });
        });
    });

    // open survey survey
    $(document).on('click', '#open-survey', function () {
        var url = $(this).attr('data-url');
        confirmDanger({message: Lang.get('lang.comfirm_open_survey')}, function () {
            $.ajax({
                method: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('#close-survey').removeClass('hide-div');
                        $('#open-survey').addClass('hide-div');
                        alertSuccess({message: data.message});
                    } else {
                        alertDanger({message: data.message});
                    }
                }
            });
        });
    });
});

function handelManagement(event) {
    $('.menu-management').removeClass('active');
    event.addClass('active');
}
