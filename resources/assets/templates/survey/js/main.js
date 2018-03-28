$(document).ready(function() {  
    $('#who .item-inner').matchHeight();    
    $('#testimonials .item-inner .quote').matchHeight(); 
    $('#latest-blog .item-inner').matchHeight(); 
    $('#services .item-inner').matchHeight();
    $('#team .item-inner').matchHeight();
    $('#work-list .item .content').matchHeight();
    
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
});
