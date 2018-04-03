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

    // dropdown menu select element
    $('.survey-select-styled').click(function(e) {
        e.stopPropagation();
        $('div.survey-select-styled.active').not(this).each(function() {
            $(this).removeClass('active').next('ul.survey-select-options').hide();
        });
        $(this).toggleClass('active').next('ul.survey-select-options').toggle();
    });
  
    $('.survey-select-options li').click(function(e) {
        e.stopPropagation();
        $('div.survey-select-styled').html($(this).html()).removeClass('active');
        $('.survey-select-options').hide();
        $('.survey-select-styled').removeClass('active');
    });

    $(document).click(function() {
        $('.survey-select-styled').removeClass('active');
        $('.survey-select-options').hide();
    });

    // required btn
    $('.question-required-checkbox label .toggle').click(function () {
        $(this).toggleClass('active');
        var checked = $(this).prev().attr('checked');
        $(this).prev().attr('checked', !checked);
    });

    // hide-show element block
    $('.form-line').click(function () {
        $('.form-line').each(function () {
            $(this).removeClass('question-active');
            $(this).children().children().children('.question-input').addClass('active');
            $(this).children().children().children('.question-input').blur();
        });
        
        $(this).addClass('question-active');
        $(this).children().children().children('.question-input').removeClass('active');
        $(this).children().children().children('.question-input').focus();
    });
});
