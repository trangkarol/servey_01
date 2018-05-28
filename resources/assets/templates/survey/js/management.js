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
});

function handelManagement(event) {
    $('.menu-management').removeClass('active');
    event.addClass('active');
}
