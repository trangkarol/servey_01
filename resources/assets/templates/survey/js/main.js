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
});
