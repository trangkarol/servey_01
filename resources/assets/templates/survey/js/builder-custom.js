jQuery(document).ready(function () {
    //cache DOM elements

    /* Selecting form components*/
    $("li.sort").on('click', function () {
        $('.form-line').removeClass("liselected");
        $(this).addClass("liselected");
    });

    // This is for resize window
    $(function () {
        $(window).bind("load resize", function () {
            var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
            if (width < 1170) {
                $('body').addClass('content-wrapper');
            } else {
                $('body').removeClass('content-wrapper');
            }
        });
    });

    /* Datetimepicker */

    $('#start-time').datetimepicker();

    $('#end-time').datetimepicker();

    /**
     * Scroll button
     */

    function setTop(selector) {
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width > 768) {
            var currentScrollTop = $(this).scrollTop();
            var buttonPosition = currentScrollTop + 5;
            selector.css('top', buttonPosition);
        } else {
            selector.css('top', '');
        }
    }

    $(window).scroll(function() {
        setTop($(".button-group-sidebar"));
    });

    $(window).resize(function() {
        setTop($(".button-group-sidebar"));
    });

    $('.survey-action').on('click', function (e) {
        e.preventDefault();
    });

    $("#sortable1").sortable({
        axis: 'y',
        cursor: 'pointer',
        connectWith: ".page-section",
        cancel: '.no-sort',
        change: function (event, ui) {
            if (ui.placeholder.index() < 1) {
                $('.sortable-first').after(ui.placeholder);
            }
        },
        stop: function (event, ui) {
            $(ui.item).removeAttr('style');
        },
    }).disableSelection();

    $('.content-wrapper form').on('click', '.remove-element', function (event) {
        $(this).parent('li').remove();
    });

    // auto resize textarea
    $.each($('textarea[data-autoresize]'), function() {
        var offset = this.offsetHeight - this.clientHeight;

        var resizeTextarea = function(el) {
            $(el).css('height', 'auto').css('height', el.scrollHeight + offset);
        };

        $(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
    });
});
