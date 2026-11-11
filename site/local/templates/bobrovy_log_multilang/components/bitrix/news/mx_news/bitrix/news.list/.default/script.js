(function(){
 
    var ajaxPagerLoadingClass   = 'ajax-pager-loading',
        ajaxPagerWrapClass      = 'ajax-pager-wrap',
        ajaxPagerLinkClass      = 'ajax-pager-link',
        ajaxWrapAttribute       = 'wrapper-class',
        ajaxPagerLoadingTpl     = ['<span class="' + ajaxPagerLoadingClass + '">', 
                                       '<img src="/upload/loading.gif"/>',     
                                   '</span>'].join(''),
        busy = false,
 
 
        attachPagination = function (wrapperClass){
            var $wrapper = $('.' + wrapperClass),
                $window  = $(window);
 
            if($wrapper.length && $('.' + ajaxPagerWrapClass).length){
                $window.on('scroll', function() {
                    if(($window.scrollTop() + $window.height()) > 
                        ($wrapper.offset().top + $wrapper.height()) && !busy) {
                        busy = true;
                        $('.' + ajaxPagerLinkClass).click();
                    }
                });
            }
        },
 
 
        ajaxPagination = function (e){
            e.preventDefault();
 
            busy = true;
            var wrapperClass = $('.'+ajaxPagerLinkClass).data(ajaxWrapAttribute),
                $wrapper = $('.' + wrapperClass),
                $link = $(this);
 
            if($wrapper.length){
                $('.' + ajaxPagerWrapClass).append(ajaxPagerLoadingTpl);
                $.get($link.attr('href'), {'AJAX_PAGE' : 'Y'}, function(data) {
                    $('.' + ajaxPagerWrapClass).remove();
                    $wrapper.append(data);
                    attachPagination(wrapperClass);
                    busy = false;
                });
            }
        };  
 
    $(function() {
        if($('.'+ajaxPagerLinkClass).length 
            && $('.'+ajaxPagerLinkClass).data(ajaxWrapAttribute).length){
            attachPagination($('.'+ajaxPagerLinkClass).data(ajaxWrapAttribute));
            $(document).on('click', '.' + ajaxPagerLinkClass, ajaxPagination);
        }
    });    
 
})();

