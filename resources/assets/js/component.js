$(document).ready(function() {
    var error = $('.data').attr('data-error');
    var notice = $('.data').attr('data-confirm');
    var link = $('.data').attr('data-link');
    var email_confirm = $('.data').attr('data-email-invalid');

    $('.submit-answer').prop('disabled', false);

    $(document).on('click', '.active-answer', function() {
        $('.container-list-answer').fadeIn();
        $('.container-list-result').fadeOut();
    });

    $(document).on('click', '.active-result', function() {
        $('.container-list-result').fadeIn();
        $('.container-list-answer').fadeOut();
    });

    $('.image-type-option').hover(
        function() {
            $(this).siblings('span').css('display', 'block');
        }, function() {
            $(this).siblings('span').css('display', 'none');
        }
    );

    setTimeout(function() {
            $('.complete-image').addClass('jello');
        }, 1000);

    $(document).on('click', '.choose-image', function() {
        $('.button-file-hidden').click();
    });

    $(document).on('click', '.tag-send-email', function() {
        var url = $(this).attr('data-url');
        $('.frm-submit-mail').attr('action', url);
        $('.popupBackground').fadeIn();
    });

    $(document).on('click', '.btn-remove-survey', function() {
        var result = confirm(notice);

        if (result) {
            var url = $(this).attr('data-url');
            var idSurvey = $(this).attr('id-survey');
            var redirect = $(this).attr('redirect');
            $.post(
                url,
                {
                    'idSurvey': idSurvey,
                },
                function(response) {

                    if (response.success) {
                        window.location.href = redirect;
                    }
                    
                    alert(error);
                }
            );
        }
    });

    $('.datetimepicker').datetimepicker();

    $('.frm-date-2').datetimepicker({
        format: 'MM/DD/YYYY'
    });

    $('.frm-time').datetimepicker({
        format: 'LT'
    });

    $(document).on('click', '.view-result', function() {
        window.location.href = $(this).attr('data-url');
    });

    $(document).on('click', '.menu-wizard', function() {
        $('.menu-wizard').removeClass('active-menu');
        $(this).addClass('active-menu');
    });

    $('.alert-message').delay(5000).slideUp(300);

    $('.save-message-success').delay(5000).slideUp(300);

    $('.save-message-fail').delay(5000).slideUp(300);

    $('.save-survey').on('click', function () {
        var surveyId = $(this).attr('survey-id');
        var url = $(this).attr('data-url');
        var feature = $(this).attr('feature');
        var userId = $(this).attr('user-id');
        var answer = $('#wrapped').serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
    
            return obj;
        }, {});

        $.post(
            url,
            {
                'surveyId': surveyId,
                'answer': answer,
                'feature': feature,
                'userId': userId,
            },
            function (response){
                if (response.success) {
                    $(".save-message-success").css("display", "block");
                    $('.save-message-success').append(response.message);
                } else {
                    $(".save-message-fail").css("display", "block");
                    $('.save-message-false').append(response.message);
                }
        });
    });

    $('.show-survey').on('click', function () {
        var url = $(this).attr('data-url');
        var surveyId = $(this).attr('survey-id');

        $.get(
            url,
            {
                'surveyId': surveyId,
            },
            function (response) {
                if (response.success) {
                    $(".save-message-success").css("display", "block");
                    $('.save-message-success').append(response.message);
                    $('#container-survey').html(response.view);
                } else {
                    $(".save-message-fail").css("display", "block");   
                    $('.save-message-fail').append(response.message);
                }
        });
    });

    var number = parseInt($('.ct-data').attr('data-number'));
    var charts = $('.ct-data').attr('data-content');
    
    if (charts) {
        var obj = jQuery.parseJSON( charts );

        for (i = 0; i < obj.length; i++) {
            var dataInput = new Array();

            for (j = 0; j < obj[i]['chart'].length; j++) {
                dataInput.push([obj[i]['chart'][j]['answer'], obj[i]['chart'][j]['percent']]);
            }
            var count = i + 1;
            if(dataInput.length != 1) {
                Highcharts.chart('container' + i, {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        },
                        style: {
                            fontFamily: 'Arial'
                        },
                        spacingBottom: 15,
                        spacingTop: 70,
                        spacingLeft: 70,
                        spacingRight: 70,
                    },
                    title: {
                        text: count + '.' + obj[i]['question']['content'],
                        floating: true,
                        align: 'left',

                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'Browser share',
                        data: dataInput
                    }]
                });
            }
        }
    }
});
