$(document).ready(function() {
    var error = $('.data').attr('data-error');

    function addAnwser($this) {
        var url = $this.attr('url');
        var type = $this.attr('typeId');
        var number = parseInt($($this).attr('id-as'));
        var trash = parseInt($('.question' + number).attr('trash'));
        var num_as = (parseInt($('.question' + number).attr('temp-qs')) + 1);
        $.post(
            url,
            {
                'number': number,
                'num_as': num_as,
                'type': type,
            },
            function(response) {

                if (response.success) {
                    $('.temp-other' + number +':first').before(response.data);
                    $('.question' + number).attr('temp-qs', num_as);
                    $('.question' + number).attr('trash', trash + 1);
                } else {
                    alert(error);
                }
        });
    }

    function addOtherButton($this, class_temp) {
        var number = parseInt($this.parent().parent().find(class_temp).attr('id-as'));
        var type = $this.attr('typeId');
        var url = $this.attr('url');
        $.post(
            url,
            {
                'number': number,
                'type': type,
            },
            function(response) {

                if (response.success) {
                    $('.temp-other' + number + ':first').before(response.data);
                } else {
                    alert(error);
                }
        });
        $this.hide();
    }

    function addQuestion($this) {
        var number = parseInt($('.data').attr('data-number')) + 1;
        var number_qs = parseInt($('.data').attr('data-question')) + 1;
        var type = $this.attr('typeId');
        var url = $this.attr('url');
        $.post(
            url,
            {
                'number': number,
                'type': type,
            },
            function(response) {

                if (response.success) {
                    $('.hide').before(response.data);
                    $('.data').attr('data-number', number);
                    $('.data').attr('data-question', number_qs);
                    $('.div-finish').css('display', 'block');
                } else {
                    alert(error);
                }
        });
    }

    $(document).on('click', '.add-radio', function() {
        addAnwser($(this));
    });

    $(document).on('click', '.add-checkbox', function() {
        addAnwser($(this));
    });

    $(document).on('click', '.add-radio-other',  function() {
        var class_temp = '.add-radio';
        addOtherButton($(this), class_temp);
    });

    $(document).on('click', '.add-checkbox-other', function() {
        var class_temp = '.add-checkbox';
        addOtherButton($(this), class_temp);
    });

    $(document).on('click', '#radio-button', function() {
        addQuestion($(this));
    });

    $(document).on('click', '#checkbox-button', function() {
        addQuestion($(this));
    });

    $(document).on('click', '#text-button', function() {
        addQuestion($(this));
    });

    $(document).on('click', '#time-button', function() {
        addQuestion($(this));
    });

    $(document).on('click', '#date-button', function() {
        addQuestion($(this));
    });

    $(document).on('click', '.title-question', function() {
        $(this).children('.choose-action').fadeIn(2000);
        $(this).find('.remove-answer').fadeIn(2000);
    });

    $(document).on('click', '.glyphicon-trash', function() {
        var number_qs = parseInt($('.data').attr('data-question')) - 1;
        var idQuestion = $(this).attr('id-question');

        if(number_qs == 0) {
            $('.div-finish').css('display', 'none');
        }

        $('.data').attr('data-question', number_qs);
        $('.question' + idQuestion).removeClass('animate zoomIn');
        $('.question' + idQuestion).addClass('animate fadeOutDown');
        setTimeout(function() {
          $('.question' + idQuestion).remove();
        }, 1000);
    });

    $(document).on('click', '.glyphicon-remove', function() {
        var number = parseInt($(this).attr('num'));
        var trash = parseInt($('.question' + number).attr('trash'));
        var idAnwser = $(this).attr("id-as");

        if (trash > 2) {
            $('.question' + number).attr('trash', trash - 1);
            $('.clear-as' + idAnwser).remove();
            $('.qs-as' + idAnwser).remove();
        }
    });

    $(document).on('click', '.remove-other', function() {
        var idAnwser = $(this).attr('id-qs');
        $('.temp-other' + idAnwser + ':last').remove();
        $('.answer-other' + idAnwser).remove();
        $('.other' + idAnwser).show();
    });

    $(document).on('click', '.bt-action', function() {
        var url = $(this).attr('url');
        window.location = url;
    });

    $(document).on('click', '.option-add', function() {
        var url = $(this).attr('url');
        var temp_as = $(this).attr('temp-as');
        var temp_qs = $(this).attr('temp-qs');

        if ($(this).prop('checked')) {
            $.post(
                url,
                {
                    'idQuestion': temp_qs,
                    'idAnswer': temp_as,
                },
                function(response) {

                    if (response.success) {
                        $('.append-as' + temp_qs).html(response.data);
                    } else {
                        alert(error);
                    }
            });
        } else {
            $('.input' + temp_qs).remove();
        }
    });

    $(document).on('click', '.option-choose', function() {
        var temp_qs = $(this).attr('temp-qs');
        $('.input' + temp_qs).remove();
    });
});
