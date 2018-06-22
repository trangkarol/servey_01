$(document).ready(function () {
    var url = $('.url_onwer').val();
    $('.list-survey-ajax').click(function (e) {
        e.preventDefault();
        url = $(this).attr('data-url');
        $('.list-survey-ajax').removeClass('active');
        $(this).addClass('active');
        listSurvey(url, 'list-survey-ajax');
    });

    reloadPagination();

    $(document).on('click', '.list-survey-owner-pagi li a', function (e) {
        e.preventDefault();
        var page = $(this).text().trim();
        var page_current = parseInt($('.page_current').val());

        if ($(this).parent('li').is(':last-child')) {
            page = page_current + 1;
        }

        if ($(this).parent('li').is(':first-child')) {
            page = page_current - 1;
        }

        urlPaginate = url + '?page=' + page;
        listSurvey(urlPaginate);
    });

    $(document).on('click', '.btn-search-survey', function (e) {
        listSurvey(url);
    });
});

function listSurvey(url, flag = 'form-search') {
    $.ajax({
        method: 'GET',
        url: url,
        data: $('.form-search-list-survey').serialize(),
        dataType: 'json',
        success: function (data) {
            $('#show-list-surveys').html(data.html).promise().done(function () {
                if (flag == 'list-survey-ajax') {
                    $('.element-search-survey').val('');
                }

                reloadPagination();
            });
        }
    });
}

function reloadPagination() {
    $('#show-list-surveys .pagination').addClass('list-survey-owner-pagi');
    $('#show-list-surveys .pagination li').addClass('page-item').find('span').addClass('page-link');
    $('#show-list-surveys .pagination li a').addClass('page-link').attr('href', 'javascript:void(0)');
}
