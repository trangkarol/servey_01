jQuery(document).ready(function () {
    var questionSelected = null;

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
    // validate url image
    function checkTimeLoadImage(e, t, i) {
        var o, i = i || 3e3,
            n = !1,
            r = new Image;
        r.onerror = r.onabort = function () {
            n || (clearTimeout(o), t('error'))
        }, r.onload = function () {
            n || (clearTimeout(o), t('success'))
        }, r.src = e, o = setTimeout(function () {
            n = !0, t('timeout')
        }, i)
    }

    // preview image in modal
    function setPreviewImage(src) {
        $('.img-preview-in-modal').attr('src', src);
    }

    // show messages validate in modal
    function showMessageImage(message, type) {
        $('.messages-validate-image').removeClass('hidden');
        $('.messages-validate-image').text(message);

        if (type == 'success') {
            $('.messages-validate-image').removeClass('messages-error');
            $('.messages-validate-image').addClass('messages-success');
        } else {
            $('.messages-validate-image').removeClass('messages-success');
            $('.messages-validate-image').addClass('messages-error');
        }
    }

    // check type file image
    function checkTypeImage(input) {
        var fileExtension = [
            'jpeg',
            'jpg',
            'png',
            'gif',
            'bmp',
            'svg',
        ];
        var fileName = input.name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);

        if ($.inArray(fileNameExt.toLowerCase(), fileExtension) == -1) {
            return false;
        }

        return true;
    }

    // validate video url, support youtube
    function validateVideoUrl(url) {
        var rulesURL = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;

        return url.match(rulesURL) ? RegExp.$1 : false;
    }

    // show messages video validate
    function showMessageVideo(message, type) {
        $('.messages-validate-video').removeClass('hidden');
        $('.messages-validate-video').text(message);

        if (type == 'success') {
            $('.messages-validate-video').removeClass('messages-error');
            $('.messages-validate-video').addClass('messages-success');
        } else {
            $('.messages-validate-video').removeClass('messages-success');
            $('.messages-validate-video').addClass('messages-error');
        }
    }

    // preview video in modal
    function setPreviewVideo(src, thumbnailVideo = '') {
        $('.video-preview').attr('src', src);
        $('.video-preview').attr('data-thumbnail', thumbnailVideo);
    }

    // upload image
    function uploadImage(formData, url) {
        $.ajax({
            method: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function (response) {
            if (response) {
                showMessageImage(Lang.get('lang.image_preview'), 'success');
                setPreviewImage(response);
            } else {
                showMessageImage(Lang.get('lang.upload_image_fail'));
                setPreviewImage('');
            }
        })
        .fail(function (response) {
            var errors = JSON.parse(response.responseText)
            showMessageImage(errors.image);
            setPreviewImage('');
        });
    }

    // reset modal image
    function resetModalImage() {
        $('.input-url-image').val('');
        $('.messages-validate-image').text('');
        $('.img-preview-in-modal').attr('src', '');
        $('.input-upload-image').val('');
    }
    /* Selecting form components*/
    $('.survey-form').on('click', 'ul.sortable li.sort', function () {
        $('.form-line').removeClass('liselected');
        $(this).addClass('liselected');
        setScrollButtonTop($('.button-group-sidebar'), $(this).position().top - 96);
        questionSelected = $(this);
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

    $(window).scroll(function() {
        setScrollButtonTopByScroll($('.button-group-sidebar'));
    });

    $(window).resize(function() {
        setScrollButtonTopByScroll($('.button-group-sidebar'));
    });

    /**
     * Form sortable
     */

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

        if ($(this).children('.option-menu-selected').hasClass('active')) {
            $(this).closest('li.form-line').find('.description-input').addClass('active');
        } else {
            $(this).closest('li.form-line').find('.description-input .question-description-input').val('');
            $(this).closest('li.form-line').find('.description-input .question-description-input').keyup();
            $(this).closest('li.form-line').find('.description-input').removeClass('active');
        }
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

    $('#add-question-btn, #add-title-description-btn').click(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'GET',
            url: $(this).data('url'),
        })
        .done(function (data) {
            if (data.success) {
                var element = $('<div></div>').html(data.html).children().first();
                if (questionSelected == null) {
                    var endSection = $('.survey-form').find('ul.sortable').last().find('.end-section').first();
                    questionSelected = $(element).insertBefore(endSection);
                } else {
                    questionSelected = $(element).insertAfter(questionSelected);
                }
                questionSelected.click();
            }
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
                var element = $('<div></div>').html(data.html).children().first();
                $('.survey-form').append(element);
                formSortable();
                $('.option-menu-group .option-menu-dropdown .remove-element').click(function (event) {
                    event.preventDefault();
                    $(this).closest('li.form-line').fadeOut(300).remove();
                });
                element.find('li.sort').first().click();
            }
        });
    });

    // insert image to section
    $('#add-image-section-btn').click(function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('.btn-insert-image').remove();
        $('.btn-group-image-modal').append(`
            <button class="btn btn-success btn-insert-image"
            id="btn-insert-image-section" data-dismiss="modal">${Lang.get('lang.insert_image')}</button>`
        );
        $('#modal-insert-image').modal('show');

        $('#btn-insert-image-section').click(function () {
            var imageURL = $('.img-preview-in-modal').attr('src');

            if (imageURL) {
                $.ajax({
                    method: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {
                        'imageURL': imageURL,
                    }
                })
                .done(function (data) {
                    if (data.success) {
                        var element = data.html;

                        if (questionSelected == null) {
                            var endSection = $('.survey-form').find('ul.sortable').last().find('.end-section').first();
                            questionSelected = $(element).insertBefore(endSection);
                        } else {
                            questionSelected = $(element).insertAfter(questionSelected);
                        }

                        questionSelected.click();
                    }
                });
            } else {
                $('#modal-insert-image').modal('hide');
            }

            resetModalImage();
        });
    });

    // insert video to section
    $('.btn-insert-video').click(function (e) {
        e.preventDefault();
        var thumbnailVideo = $('.video-preview').data('thumbnail');
        var urlEmbed = $('.video-preview').attr('src');

        if (urlEmbed) {
            $.ajax({
                method: 'POST',
                url: $(this).data('url'),
                dataType: 'json',
                data: {
                    'thumbnailVideo': thumbnailVideo,
                    'urlEmbed': urlEmbed,
                }
            })
            .done(function (data) {
                if (data.success) {
                    var element = data.html;

                    if (questionSelected == null) {
                        var endSection = $('.survey-form').find('ul.sortable').last().find('.end-section').first();
                        questionSelected = $(element).insertBefore(endSection);
                    } else {
                        questionSelected = $(element).insertAfter(questionSelected);
                    }

                    questionSelected.click();
                    $('#modal-insert-video').modal('hide');
                }
            });
        } else {
            $('#modal-insert-video').modal('hide');
        }

        resetModalImage();
    });

    // add image to question
    $('.survey-form').on('click', '.question-image-btn', function (e) {
        e.preventDefault();
        var questionInsert = $(this).closest('.answer-block');
        var imageQuestionHidden = $(questionInsert).find('.image-question-hidden');
        var url = $(this).data('url');
        $('.btn-insert-image').remove();
        $('.btn-group-image-modal').append(`
            <button class="btn btn-success btn-insert-image"
            id="btn-insert-image-question" data-dismiss="modal">${Lang.get('lang.insert_image')}</button>`
        );
        $('#modal-insert-image').modal('show');

        $('#btn-insert-image-question').click(function () {
            var imageURL = $('.img-preview-in-modal').attr('src');

            if (imageURL) {
                $.ajax({
                    method: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {
                        'imageURL': imageURL,
                    }
                })
                .done(function (data) {
                    if (data.success) {
                        var element = data.html
                        $(element).insertAfter(questionInsert);
                        $(imageQuestionHidden).val(data.imageURL);
                    }

                    $('#modal-insert-image').modal('hide');
                });
            } else {
                $('#modal-insert-image').modal('hide');
            }

            resetModalImage();
        });
    });

    // add image to answer
    $('.survey-form').on('click', '.upload-choice-image', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var answerInsert = $(this).parent();
        var imageAnswerHidden = $(this).closest('.choice-sortable').find('.image-answer-hidden');
        var uploadChoiceTag = $(this);
        $('.btn-insert-image').remove();
        $('.btn-group-image-modal').append(`
            <button class="btn btn-success btn-insert-image"
            id="btn-insert-image-answer" data-dismiss="modal">${Lang.get('lang.insert_image')}</button>`
        );
        $('#modal-insert-image').modal('show');

        $('#btn-insert-image-answer').click(function () {
            var imageURL = $('.img-preview-in-modal').attr('src');

            if (imageURL) {
                $.ajax({
                    method: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {
                        'imageURL': imageURL,
                    }
                })
                .done(function (data) {
                    if (data.success) {
                        var element = data.html;
                        $(element).insertAfter(answerInsert);
                        $(imageAnswerHidden).val(data.imageURL);
                        $(uploadChoiceTag).addClass('hidden');
                        $('#modal-insert-image').modal('hide');
                    }
                });
            } else {
                $('#modal-insert-image').modal('hide');
            }

            resetModalImage();
        });
    });

    function removeImage(url, imageURL) {
        var regexURL = /^http+/;

        if (!regexURL.test(imageURL)) {
            $.ajax({
                method: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    'imageURL': imageURL.replace('/storage', 'public'),
                }
            });
        }
    }

    // remove image answer
    $('.survey-form').on('click', '.remove-image-answer', function () {
        $('.upload-choice-image').removeClass('hidden');
        var url = $(this).data('url');
        var imageAnswerTag = $(this).parent().children('.answer-image-url');
        var imageURL = $(imageAnswerTag).attr('src');
        removeImage(url, imageURL);
        var imageAnswerHidden = $(this).closest('.choice-sortable').find('.image-answer-hidden');
        $(imageAnswerHidden).val('');
        $(this).closest('.image-answer').remove();
    });

    // show option image section
    $('.survey-form').on('click', '.option-image-section', function (e) {
        e.stopPropagation();
        var optionMenuSelected = $(this).children('.option-menu-image');
        $(optionMenuSelected).toggleClass('show');
    });

    // hide option image section
    $(document).on('click', function () {
        $('.option-menu-image').removeClass('show');
    });

    // show option image question
    $('.survey-form').on('click', '.option-image-question', function (e) {
        e.stopPropagation();
        var optionMenuSelected = $(this).children('.option-menu-image');
        $((optionMenuSelected)).toggleClass('show');
    });

    // hide option image question
    $(document).on('click', function () {
        $('.option-menu-image').removeClass('show');
    });

    // remove image question
    $('.survey-form').on('click', '.remove-image', function (e) {
        e.stopPropagation();
        var imageQuestionTag = $(this).closest('.show-image-question').children('.image-question-url');
        var imageURL = $(imageQuestionTag).attr('src');
        var url = $(this).data('url');
        removeImage(url, imageURL);
        var imageQuestionHidden = $(this).closest('.form-line').find('.image-question-hidden');
        $(imageQuestionHidden).val('');
        $(this).closest('.image-question').remove();
    });

    // remove image section
    $('.survey-form').on('click', '.remove-image-section', function (e) {
        e.stopPropagation();
        var imageSectionTag = $(this).closest('.box-show-image').children('.show-image-insert-section');
        var imageURL = $(imageSectionTag).attr('src');
        var url = $(this).data('url');
        removeImage(url, imageURL);
        $(this).closest('.section-show-image-insert').remove();
    });

    // show video option
    $('.survey-form').on('click', '.option-image-video', function (e) {
        e.stopPropagation();
        $(this).children('.option-menu-image').toggleClass('show');
    });

    // remove video section
    $('.survey-form').on('click', '.remove-video', function (e) {
        e.stopPropagation();
        $(this).closest('.section-show-image-insert').remove();
    })

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

    // insert image by url
    $('.input-url-image').on('keyup', function () {
        var urlImage = $(this).val().trim();

        if (!urlImage) {
            showMessageImage(Lang.get('lang.url_is_required'));
        } else {
            checkTimeLoadImage(urlImage, function (result) {
                if (result == 'success') { // is image url
                    setPreviewImage(urlImage);
                    showMessageImage(Lang.get('lang.image_preview'), 'success');
                } else { // timeout or not image url
                    setPreviewImage('');
                    showMessageImage(Lang.get('lang.url_is_invalid'));
                }
            });
        }
    });

    // insert image by upload from local
    $(document).on('click', '.btn-upload-image', function () {
        $('.input-upload-image').trigger('click');

        $(document).on('change', '.input-upload-image', function () {
            var formData = new FormData();
            var url = $(this).data('url');
            formData.append('image', this.files[0]);
            uploadImage(formData, url);
        });
    });

    // insert url video
    $('.input-url-video').on('keyup', function () {
        var urlVideo = $(this).val().trim();
        var videoInfo = { url: urlVideo };
        var thumbnailYoutube = 'https://img.youtube.com/vi/';
        var embedYoutube = 'https://www.youtube.com/embed/';

        if (!urlVideo) {
            showMessageVideo(Lang.get('lang.url_is_required'));
            setPreviewVideo('');
        } else {
            var rulesURL = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;

            if (urlVideo.match(rulesURL)) {
                videoInfo.type = 'video';
                videoInfo.id = RegExp.$1;
                var thumbnailVideo = thumbnailYoutube + videoInfo.id + '/hqdefault.jpg';
                videoInfo.thumbnail = thumbnailVideo;
                showMessageVideo(Lang.get('lang.video_preview'), 'success');
                var embedURLVideo = embedYoutube + videoInfo.id;
                setPreviewVideo(embedURLVideo, thumbnailVideo);
            } else {
                showMessageVideo(Lang.get('lang.url_is_invalid'));
                setPreviewVideo('');
            }
        }
    });

    $('#confirm-reply').change(function(event) {
        var check = $(this).prop('checked');

        if (check) {
            $('.setting-choose-confirm-reply').show('300');
            $('.setting-radio-request').removeAttr('disabled');
        } else {
            $('.setting-choose-confirm-reply').hide('300')
            $('.setting-radio-request').attr('disabled', true);
        }
    });

    $('#checkbox-mail-remind').change(function(event) {
        var check = $(this).prop('checked');

        if (check) {
            $('.setting-mail-remind').show('300');
            $('.radio-mail-remind').removeAttr('disabled');
        } else {
            $('.setting-mail-remind').hide('300')
            $('.radio-mail-remind').attr('disabled', true);
        }
    });

    $('#limit-number-answer').change(function(event) {
        var check = $(this).prop('checked');

        if (check) {
            $('.number-limit-number-answer').show('300');
        } else {
            $('.number-limit-number-answer').hide('300')
        }
    });

    var minAnswer = parseInt($('#quantity-answer').attr('min'));
    var maxAnswer = parseInt($('#quantity-answer').attr('max'));

    $('#btn-minus-quantity').click(function(event) {
        var quantity = parseInt($('#quantity-answer').val());

        if (!isNaN(quantity) && quantity > minAnswer) {
            $('#quantity-answer').val(--quantity);
        }

        return false;
    });

    $('#btn-plus-quantity').click(function(event) {
        var quantity = parseInt($('#quantity-answer').val());
        if (!isNaN(quantity) && quantity < maxAnswer) {
            $('#quantity-answer').val(++quantity);
        }

        return false;
    });

    $('#quantity-answer').blur(function(event) {
        if (parseInt($(this).val()) < minAnswer || parseInt($(this).val()) > maxAnswer) {
            $(this).val(minAnswer);
        }
    });
});
