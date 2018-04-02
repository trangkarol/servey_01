$(document).ready(function() {  
    $(this).scrollTop(0);
    $('#loader').delay(1000).slideUp(1300);

    $(window).on('scroll', function() {  
        if ($(window).scrollTop() > 80 ) {
            $('#header').addClass('header-shrink');
        } else {
            $('#header').removeClass('header-shrink');             
        }
    });

    $('#change-avatar').click(function(e) {
        e.preventDefault();
        $("#upload-avatar:hidden").trigger('click');

        return false;
    });
    
    $('#upload-avatar').change(function(e) {
        $('.browse-your-computer').css('display', 'none');
        $('.name-picture-profile').text($('#upload-avatar').val().split('\\').pop());
        $('.submit-image-profile').show(300);
    });

    if ($('.datepicker').length) {
        var id = $('.calendar').attr('id');
        var locale = 'mm/dd/yyyy';

        if (id == 'vn') {
            locale = 'dd/mm/yyyy';
        }
        
        $('.datepicker').datepicker({
            format: locale,
        });
    }

    $('.alert-message').delay(3000).slideUp(300);

    $('.counter').each(function() {
        var $this = $(this);
        var countTo = $this.attr('data-count');

        $({countNum: $this.text()}).animate({
            countNum: countTo
        }, {
            duration: 3000,
            easing:'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });  
    });

    // languages
    $('.nav-link').click(function() {
        $('.select-options').hide();
        $('.select-styled').removeClass('active');
    });

    $('.select-styled').click(function(e) {
        e.stopPropagation();
        $('.dropdown-menu').each(function() {
            if ($(this).hasClass('show')) {
                $(this).removeClass('show');
            }  
        })
        $('div.select-styled.active').not(this).each(function() {
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $('.select-options li').click(function(e) {
        e.stopPropagation();
        $('div.select-styled').html($(this).html()).removeClass('active');
        $('#language').val($(this).attr('rel'));
        $('.select-options').hide();
        $('.select-styled').removeClass('active');
    });

    $(document).click(function() {
        $('.select-styled').removeClass('active');
        $('.select-options').hide();
    });
});
