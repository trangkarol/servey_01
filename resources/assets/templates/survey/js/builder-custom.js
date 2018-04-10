jQuery(document).ready(function () {
    /* Selecting form components*/
    $('.survey-form').on('click', 'ul.sortable li.sort', function () {
        $('.form-line').removeClass('liselected');
        $(this).addClass('liselected');
        setScrollButtonTop($('.button-group-sidebar'), $(this).position().top - 96);
    });

    // This is for resize window
    $(function () {
        $(window).bind('load resize', function () {
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

    function setScrollButtonTop(selector, offset) {
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width > 768) {
            selector.css('top', offset);
        } else {
            selector.css('top', '');
        }
    }

    function setScrollButtonTopByScroll(selector) {
        var currentScrollTop = $(this).scrollTop();
        var elementPosition = currentScrollTop + 5;
        setScrollButtonTop(selector, elementPosition);
    }

    $(window).scroll(function() {
        setScrollButtonTopByScroll($('.button-group-sidebar'));
    });

    $(window).resize(function() {
        setScrollButtonTopByScroll($('.button-group-sidebar'));
    });

    /**
     * Form sortable
     */

    function formSortable() {
        $('.survey-form ul.sortable').sortable({
            axis: 'y',
            containment: '.content-wrapper',
            handle: '.draggable-area',
            cursor: 'move',
            classes: {
                'ui-sortable-helper': 'hightlight'
            },
            connectWith: '.page-section',
            items: '> li:not(:first)',
            forcePlaceholderSize: true,
            start: function(e, ui) {
                if (ui.item.height() > 240) {
                    ui.item.offset(ui.placeholder.offset());
                    ui.item.height(240);
                    ui.placeholder.height(240);
                } else {
                    ui.placeholder.height(ui.item.height());
                }
            },
            stop: function (event, ui) {
                $(ui.item).removeAttr('style');
            },
        });
    }

    formSortable();

    /**
     * Select text in the input element when focus
     */

    $('.survey-form').on('focus', '.page-section input', function (e) {
        $(this).select();
    });

    $('.content-wrapper form').on('click', '.remove-element', function (event) {
        event.preventDefault();
        $(this).closest('li').fadeOut(300).remove();
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
    $('.survey-form').on('click', '.survey-select-styled', function(e) {
        e.stopPropagation();
        $('.survey-select-options').hide();
        $('ul.option-menu-dropdown').hide();
        $('.section-select-options').hide();
        $('div.survey-select-styled.active').not(this).each(function() {
            $(this).removeClass('active').next('ul.survey-select-options').hide();
        });
        $(this).toggleClass('active').next('ul.survey-select-options').toggle();
    });

    $('.survey-form').on('click', '.survey-select-options li', function(e) {
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
    $('.survey-form').on('click', '.question-required-checkbox label .toggle', function () {
        $(this).toggleClass('active');
        var checked = $(this).prev().attr('checked');
        $(this).prev().attr('checked', !checked);
    });

    // hide-show element block
    $('.survey-form').on('click', '.page-section .form-line', function () {
        $('.form-line').each(function () {
            $(this).removeClass('question-active');
            $(this).find('.question-input').addClass('active');
            $(this).find('.question-input').parent().addClass('col-xl-12');
            $(this).find('.element-content').removeClass('hidden');
            $(this).find('.question-description-input').removeClass('hidden');
            $(this).find('.question-description-input').addClass('active');
        });

        $(this).closest('.survey-form').find('.zoom-btn').removeClass('zoom-out-btn');
        $(this).closest('.survey-form').find('.zoom-btn').addClass('zoom-in-btn');
        $(this).addClass('question-active');
        $(this).find('.question-input').removeClass('active');
        $(this).find('.question-input').parent().removeClass('col-xl-12');
        $(this).find('.question-description-input').removeClass('active');
    });

    $('.survey-form').on('focus', '.question-input', function () {
        $(this).parent().parent().parent().click();
    });

    // survey option menu
    $('.survey-form').on('click', '.option-menu-group', function(e) {
        e.stopPropagation();
        $('.survey-select-options').hide();
        $('ul.option-menu-dropdown').hide();
        $('.section-select-options').hide();
        $(this).children('.option-menu').toggleClass('active').next('ul.option-menu-dropdown').toggle();

        return false;
    });

    $(document).click(function() {
        $('.option-menu').removeClass('active');
        $('.option-menu-dropdown').hide();
    });

    $('.survey-form').on('click', '.option-menu-dropdown li', function(e) {
        e.stopPropagation();
        $(this).children('.option-menu-selected').toggleClass('active');
        $(this).parent().hide();
        var descriptionInput = '';

        if ($(this).children('.option-menu-selected').hasClass('active')) {
            descriptionInput = $('#element-clone').find('.question-description-input').clone();
            descriptionInput.attr('data-autoresize', '');
        }

        $(this).closest('li.form-line').find('.description-input').children('div').html(descriptionInput);

        $.each($('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function(el) {
                $(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };

            $(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
        });

        $('.question-description-input').keypress(function(e) {
            if ((e.keyCode || e.which) === 13) {
                return false;
            }
        });
    });

    $('.survey-form').on('keypress', '.question-input, .question-description-input', function(e) {
        if ((e.keyCode || e.which) === 13) {
            return false;
        }
    });

    $('.option-menu-group .option-menu-dropdown .remove-element').click(function (event) {
        event.preventDefault();
        $(this).closest('li.form-line').fadeOut(300).remove();
    });

    /**
     * multiple choice
     */

    $('.survey-form ul.sortable .multiple-choice-block').sortable({
        axis: 'y',
        handle: '.radio-choice-icon',
        containment: '.survey-form ul.sortable .multiple-choice-block',
        cursor: 'move',
        items: '.choice-sortable',
        classes: {
            'ui-sortable-helper': 'hightlight'
        },
        stop: function (event, ui) {
            $(ui.item).removeAttr('style');
        },
    });

    $('.survey-form').on('keydown', '.form-line .multiple-choice-block .choice', function (e) {
        if ($(this).hasClass('other-choice-option')) {
            return;
        }

        if (e.keyCode === 13) {
            $(this).find('.remove-choice-option').removeClass('hidden');
            var nextElement = $(this).clone().insertAfter($(this));
            var input = nextElement.find('input');
            input.val(Lang.get('lang.option', {index: nextElement.index() + 1}));
            input.select();
            input.focus();
        } else if (e.keyCode == 8 || e.keyCode == 46) {
            var currentInput = $(this).find('input');
            var previousElement = $(this).prev();

            if (!currentInput.val()) {
                if ($(this).parent().find('.choice').length > 1) {
                    $(this).fadeOut(500).remove();
                } else {
                    $(this).parent().find('.choice').find('.remove-choice-option').addClass('hidden');
                }

                // focus next element
                previousElement.find('input').select();
                // deny key action
                e.preventDefault();
            }
        }
    });

    $('.survey-form').on('click', '.form-line .multiple-choice-block .choice', function (e) {
        var input = $(this).find('input');

        if (!input.val()) {
            input.val(Lang.get('lang.option', {index: $(this).index() + 1}));
            input.select();
        }
    });

    $('.survey-form').on('blur', '.form-line .multiple-choice-block .choice', function (e) {
        var input = $(this).find('input');

        if (!input.val()) {
            input.val(Lang.get('lang.option', {index: $(this).index() + 1}));
            $(this).next().find('input').select();
        }
    });

    // remove choice option
    $('.survey-form').on('click', '.form-line .multiple-choice-block .remove-choice-option', function (e) {
        e.preventDefault();
        var option = $(this).closest('.choice.choice-sortable');

        if ($(this).closest('.multiple-choice-block').find('.choice.choice-sortable').length > 1) {
            option.fadeOut(500).remove();
        } else {
            $(this).closest('.multiple-choice-block').find('.choice.choice-sortable').find('.remove-choice-option').addClass('hidden');
        }
    });

    $('.survey-form').on('click', '.form-line .multiple-choice-block .remove-other-choice-option', function (e) {
        e.preventDefault();
        var option = $(this).closest('.choice');
        $(this).closest('.multiple-choice-block').find('.other-choice .other-choice-btn').first().show();
        option.fadeOut(500).remove();
    });

    $('.survey-form').on('click', '.form-line .multiple-choice-block .other-choice .other-choice-block .add-choice', function (e) {
        var multipleChoiceBlock = $(this).closest('.multiple-choice-block');
        var choice = $(this).closest('.multiple-choice-block').find('.choice').first();
        var nextElement;

        otherChoiceOption = multipleChoiceBlock.find('.other-choice-option');

        if (otherChoiceOption.length) {
            nextElement = choice.clone().insertBefore(otherChoiceOption);
        } else {
            nextElement = choice.clone().insertBefore($(this).closest('.other-choice'));
        }

        var input = nextElement.find('input');
        input.val(Lang.get('lang.option', {index: nextElement.index() + 1}));
        input.select();
        input.focus();
    });

    $('.survey-form').on('click', '.form-line .multiple-choice-block .other-choice .other-choice-block .add-other-choice', function (e) {
        if (!$(this).closest('.multiple-choice-block').find('.other-choice-option').first().length) {
            var otherChoice = $(this).closest('.other-choice');
            var otherChoiceOption = $('#element-clone').find('.other-choice-option').clone();
            otherChoiceOption.insertBefore(otherChoice);
            otherChoice.find('.other-choice-btn').hide();
        }
    });

    /**
     * checkboxes
     */

    $('.survey-form ul.sortable .checkboxes-block').sortable({
        axis: 'y',
        handle: '.square-checkbox-icon',
        containment: '.survey-form ul.sortable .checkboxes-block',
        cursor: 'move',
        items: '.checkbox-sortable',
        classes: {
            'ui-sortable-helper': 'hightlight'
        },
        stop: function (event, ui) {
            $(ui.item).removeAttr('style');
        },
    });

    $('.survey-form').on('keydown', '.form-line .checkboxes-block .checkbox', function (e) {
        if ($(this).hasClass('other-checkbox-option')) {
            return;
        }

        if (e.keyCode === 13) {
            $(this).find('.remove-checkbox-option').removeClass('hidden');
            var nextElement = $(this).clone().insertAfter($(this));
            var input = nextElement.find('input');
            input.val(Lang.get('lang.option', {index: nextElement.index() + 1}));
            input.select();
            input.focus();
        } else if (e.keyCode == 8 || e.keyCode == 46) {
            var currentInput = $(this).find('input');
            var previousElement = $(this).prev();

            if (!currentInput.val()) {
                if ($(this).parent().find('.checkbox').length > 1) {
                    $(this).fadeOut(500).remove();
                } else {
                    $(this).parent().find('.checkbox').find('.remove-checkbox-option').addClass('hidden');
                }

                // focus next element
                previousElement.find('input').select();
                // deny key action
                e.preventDefault();
            }
        }
    });

    $('.survey-form').on('click', '.form-line .checkboxes-block .checkbox', function (e) {
        var input = $(this).find('input');

        if (!input.val()) {
            input.val(Lang.get('lang.option', {index: $(this).index() + 1}));
            input.select();
        }
    });

    $('.survey-form').on('blur', '.form-line .checkboxes-block .checkbox', function (e) {
        var input = $(this).find('input');

        if (!input.val()) {
            input.val(Lang.get('lang.option', {index: $(this).index() + 1}));
            $(this).next().find('input').select();
        }
    });

    // remove checkbox option
    $('.survey-form').on('click', '.form-line .checkboxes-block .remove-checkbox-option', function (e) {
        e.preventDefault();
        var option = $(this).closest('.checkbox.checkbox-sortable');

        if ($(this).closest('.checkboxes-block').find('.checkbox.checkbox-sortable').length > 1) {
            option.fadeOut(500).remove();
        } else {
            $(this).closest('.checkboxes-block').find('.checkbox.checkbox-sortable').find('.remove-checkbox-option').addClass('hidden');
        }
    });

    $('.survey-form').on('click', '.form-line .checkboxes-block .remove-other-checkbox-option', function (e) {
        e.preventDefault();
        var option = $(this).closest('.checkbox');
        $(this).closest('.checkboxes-block').find('.other-checkbox .other-checkbox-btn').first().show();
        option.fadeOut(500).remove();
    });

    $('.survey-form').on('click', '.form-line .checkboxes-block .other-checkbox .other-checkbox-block .add-checkbox', function (e) {
        var checkboxBlock = $(this).closest('.checkboxes-block');
        var checkbox = $(this).closest('.checkboxes-block').find('.checkbox').first();
        var nextElement;

        otherCheckboxOption = checkboxBlock.find('.other-checkbox-option');

        if (otherCheckboxOption.length) {
            nextElement = checkbox.clone().insertBefore(otherCheckboxOption);
        } else {
            nextElement = checkbox.clone().insertBefore($(this).closest('.other-checkbox'));
        }

        var input = nextElement.find('input');
        input.val(Lang.get('lang.option', {index: nextElement.index() + 1}));
        input.select();
        input.focus();
    });

    $('.survey-form').on('click', '.form-line .checkboxes-block .other-checkbox .other-checkbox-block .add-other-checkbox', function (e) {
        if (!$(this).closest('.checkboxes-block').find('.other-checkbox-option').first().length) {
            var otherCheckbox = $(this).closest('.other-checkbox');
            var otherCheckboxOption = $('#element-clone').find('.other-checkbox-option').clone();
            otherCheckboxOption.insertBefore(otherCheckbox);
            otherCheckbox.find('.other-checkbox-btn').hide();
        }
    });

    /**
     * Sidebar scroll group button
     */

    $('#add-question-btn').click(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'GET',
            url: $(this).data('url'),
        })
        .done(function (data) {
        });
    });

    $('#add-section-btn').click(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'GET',
            url: $(this).data('url'),
        })
        .done(function (data) {
            if (data.success) {
                $('.survey-form').append(data.html);
                formSortable();
                $('.option-menu-group .option-menu-dropdown .remove-element').click(function (event) {
                    event.preventDefault();
                    $(this).closest('li.form-line').fadeOut(300).remove();
                });
            }
        });
    });

    /**
     * add Section
     */

    // section header dropdown 
    $('.survey-form').on('click', '.section-select-styled', function(e) {
        e.stopPropagation();
        $('.survey-select-options').hide();
        $('ul.option-menu-dropdown').hide();
        $('.section-select-options').hide();
        $('div.section-select-styled.active').not(this).each(function() {
            $(this).removeClass('active').next('ul.section-select-options').hide();
        });
        $(this).toggleClass('active').next('ul.section-select-options').toggle();
    });

    $('.survey-form').on('click', '.section-select-options li', function(e) {
        e.stopPropagation();
        $('div.section-select-styled').html($(this).html()).removeClass('active');
        $('.section-select-options').hide();
        $('.section-select-styled').removeClass('active');
    });

    $(document).click(function() {
        $('.section-select-styled').removeClass('active');
        $('.section-select-options').hide();
    });

    // section zoom-in zoom-out btn
    $('.survey-form').on('click', '.zoom-btn', function () {
        if ($(this).hasClass('zoom-in-btn')) {
            $(this).removeClass('zoom-in-btn');
            $(this).addClass('zoom-out-btn');

            $(this).closest('.page-section').find('.form-line').each(function () {
                $(this).removeClass('liselected');
                $(this).removeClass('question-active');
                $(this).find('.question-input').addClass('active');
                $(this).find('.question-input').parent().addClass('col-xl-12');
                $(this).find('.question-description-input').addClass('hidden');
                $(this).find('.element-content').addClass('hidden');
            });
        } else {
            $(this).removeClass('zoom-out-btn');
            $(this).addClass('zoom-in-btn');

            $(this).closest('.page-section').find('.form-line').each(function () {
                $(this).find('.question-input').addClass('active');
                $(this).find('.question-input').parent().addClass('col-xl-12');
                $(this).find('.question-description-input').removeClass('hidden');
                $(this).find('.question-description-input').addClass('active');
                $(this).find('.element-content').removeClass('hidden');
            });
        }

        return false;
    });
});
