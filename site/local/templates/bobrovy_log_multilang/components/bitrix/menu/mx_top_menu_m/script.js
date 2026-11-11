jQuery(document).ready(function($) {

    $('.mobile_menu ul li a > .open_span').click(function(e) {
        e.preventDefault();
        $(this).parent('a').next('ul').stop(true, true).slideToggle(500);
        if ($(this).hasClass('fa-plus')) {
            $(this).removeClass('fa-plus').addClass('fa-minus');
        } else {
            $(this).removeClass('fa-minus').addClass('fa-plus');
        }
    });

});

