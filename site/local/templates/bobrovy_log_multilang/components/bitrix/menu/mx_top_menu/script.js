jQuery(document).ready(function($) {

    $('.desktop_menu>ul>li>a').on('mouseover', function(e) {
        e.preventDefault();
        $(this).parent('a').next('ul').slideDown(500);
    });

    $('.desktop_menu>ul>li>a').on('mouseout', function(e) {
        e.preventDefault();
        $(this).parent('a').next('ul').slideUp(500);
    });


});

