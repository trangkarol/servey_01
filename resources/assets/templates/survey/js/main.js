$(document).ready(function() {  
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

    if ($('.datepicker').length) {
        $('.datepicker').datepicker();
    }
    
    if ($('.datepicker-embed').length) {
        $('.datepicker-embed').datepicker({
            todayHighlight: true
        });
    }

    $('.alert-message').delay(3000).slideUp(300);
    $('.counter').each(function() {
        var $this = $(this);
        var countTo = $this.attr('data-count');

        $({countNum: $this.text()}).animate({
            countNum: countTo
        }, {
            duration: 8000,
            easing:'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });  
    });
});
