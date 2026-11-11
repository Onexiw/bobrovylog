$(document)
    .on('click', '.mibok-dropdown .dropdown-menu ul', function (e) {
        e.stopPropagation();
    })
    .on('change','.mibok-slide-filter input[type=checkbox]', function(){
        $('.mibok-add-filter').animate({opacity: "toggle",height: "toggle"},1000);
        $('.mibok-add-filter').toggleClass('open');
	})
    .on('change','.dropdown-menu .scroll-visible input[type=checkbox]', function(){
        var parent = $(this).parents('.mibok-dropdown');
        var text = '';
        parent.find('input[type=checkbox]:checked').each(function(indx, element){
            if(text != '')
                text += ', ';
            text += $(element).next().html();
        })
        if(text == '')
            text = $('.mibok-word-all').text();
        if(parent.find('.mibok-filter-value').length > 0)
            parent.find('.mibok-filter-value').html(text);
        if(parent.find('.mibok-filter-list-head').length > 0)
            parent.find('.mibok-filter-list-head').html(text + ' <span class="ic-m-t-bottom"></span>');
	})
    .on('click','.mibok-show-form', function(){
        $(this).animate({opacity: "toggle",height: "toggle"},300)
        $('.mibok-wrapper-form').animate({opacity: "toggle",height: "toggle"},1000);
	})
    .on('input','#mibok-timetableModal input[type=text]', function(){
        MibokCheckSubmit();
	})
    .on('change','.main-user-consent-request input[type=checkbox]', function()
    {
        if($('.main-user-consent-request input[type=checkbox]:checked').length <= 0)
            $('.mibok-form-submit').attr('disabled', 'disabled');
        else
        {
            MibokCheckSubmit();
        }
    })
    .on('submit','#mibok-timetableModal form', function(){
        $('.mibok-modal .modal-body').animate({opacity: "toggle",height: "toggle"},1500);
	})
    .on('click', '.mibok-hover-lesson .mibok-modal-timetable', function (e){
        e.preventDefault();
    })
    .on('click','#accordion-consent .panel-title a', function(){
        if($(this).hasClass('open'))
            $(this).removeClass('open');
        else
            $(this).addClass('open');
	})
    .on("shown.bs.collapse", ".collapse", function (e) {
       $(this).find('.panel-body').perfectScrollbar('update');
    })
	.on('input','#mibok-timetableModal textarea', function(){
        MibokCheckSubmit();
	})
    ;
    
    
$(document).ready(function(){
    $('.mibok-dropdown .dropdown-menu ul').perfectScrollbar({wheelSpeed:1, minScrollbarLength:48});
    if($('.mibok-carousel-lessons').length > 0)
    {
        var lengthItem = $('.item-lesson .count-rasp').length;
        
        if($('.count-rasp').length > 0)
        { 
            var arItem = new Object;
            var iblock = $('input[name=IBLOCK_ID]').val();
            var page = $('input[name=TIMETABLE_AJAX]').val();
            $('.count-rasp').each(function(ind){
                var item = $(this).parents('.item-lesson');
                var element = item.attr('data-id');
                var time_info = item.find('input[name=TIME_INFO]').val();
                //var id = $(this).attr('id');
                
                var count_rasp = $(this);
                arItem[ind] = {ELEMENT_ID:element, TIME_INFO: time_info}
                
            });
            $.ajax({
                type: "POST",
                url: page,
                dataType: 'json',
                data: {ITEMS:arItem, IBLOCK_ID: iblock, ACTION:'GetLimit'},
                success: function(data){
                    for(var elem in data)
                    {
                        var newCountRasp = $('.count-rasp[data-rasp-id="' + data[elem]['id']+'"]');
                        if(newCountRasp.length > 0)
                        {
                            newCountRasp.addClass(data[elem]['class']).html(data[elem]['table'] + '/' + data[elem]['iblock']);
                        }
                    }
                    $('.mibok-wrapper-grid').removeClass('mibok-preloader');
                }
            });
        }
        else
        {
            $('.mibok-wrapper-grid').removeClass('mibok-preloader');
        }
    }
    if($('#datepicker').length > 0)
    {
        var opens = 'left';
        if($('body ').width() < 768)
        {
            opens = 'right';
        }
        var minDate = $('#datepicker input[name=minDate]').val();
        var dateLimit = $('#datepicker input[name=dateLimit]').val();
        var startDate = $('#datepicker input[name=period_begin]').val();
        var endDate = $('#datepicker input[name=period_end]').val();
        var arrayDay = $('#datepicker input[name=dayList]').val().split(",");
        var arrayMonth = $('#datepicker input[name=monthList]').val().split(",");
        $('#datepicker').daterangepicker({
            "autoApply": true,
            "opens": opens,
            "startDate": startDate,
            "endDate": endDate,
            "minDate": minDate,
            "dateLimit": {
                "days": dateLimit
            },
            "locale": {
                "format": "DD.MM.YYYY",
                separator:",",
                "daysOfWeek": arrayDay,
                "monthNames": arrayMonth,
                "firstDay": 1,
            },
        });

        $('#datepicker').on('apply.daterangepicker', function(e, picker){
            $('#datepicker input[name=period_begin]').val(picker.startDate.format('DD.MM.YYYY'))
            $('#datepicker input[name=period_end]').val(picker.endDate.format('DD.MM.YYYY'))
        })
    }
})



jQuery(function($) {
    $('.mibok-dropdown .dropdown-menu').parent().on('shown.bs.dropdown', function () {
        $(this).find('ul').perfectScrollbar('update');
    });
    $('#mibok-timetableModal').on('show.bs.modal', function (e) {

        var lesson = $(e.relatedTarget).parents('.item-lesson');

        var page = $('input[name=TIMETABLE_AJAX]').val();
        var field = $('input[name=FIELD_CODE_MODAL]').val();
        var prop = $('input[name=PROPERTY_CODE_MODAL]').val();
        var iblock = $('input[name=IBLOCK_ID]').val();
        var iblock_type = $('input[name=IBLOCK_TYPE]').val();
        var modal_name = $('input[name=LIST_SETTINGS_MODAL_NAME]').val();
        var modal_data = $('input[name=MODAL_DATA]').val();
        var time_info = lesson.find('input[name=TIME_INFO]').val();
        var prop_record = $('input[name=PROPERTY_CODES_RECORD]').val();
        var prop_record_req = $('input[name=PROPERTY_CODES_RECORD_REQUIRED]').val();
        var record_param = $('input[name=RECORD_PARAM]').val();
        var is_record = $('input[name=IS_RECORD]').val();
        var consent = $('input[name=CONSENT]').val();
        var sign = $('input[name=SIGN]').val();
        var element = lesson.attr('data-id');
        
        $.ajax({
            type: "POST",
            url: page,
            async: false,
            data: {ELEMENT_ID:element, FIELD:field, IBLOCK_ID: iblock, IBLOCK_TYPE:iblock_type, PROPERTY:prop, MODAL_NAME:modal_name, TIME_INFO: time_info, MODAL_DATA:modal_data, PROP_RECORD:prop_record, PROP_RECORD_REQ:prop_record_req, RECORD_PARAM:record_param, IS_RECORD:is_record, CONSENT:consent, SIGN:sign},
            success: function(data){
                $('#mibok-timetableModal .modal-content').html(data);
                var lesson = $(e.relatedTarget).parents('.item-lesson');
                lesson.addClass('emitate-hover');
                $('#mibok-timetableModal').find('.modal-content').addClass(lesson.attr('data-class-color'));

                var $bodyWidth = $("body").width();
                $("body").css({'overflow-y': "hidden"}).css({'padding-right': ($("body").width()-$bodyWidth)});
                $('.mibok-modal .modal-wrapper-info').perfectScrollbar();
                $('.mibok-panel-consent .panel-body').perfectScrollbar();
            }
          });

    })
    $('#mibok-timetableModal').on('shown.bs.modal', function (e) {
        var table= $('.mibok-modal .modal-wrapper-info .table').height();
        var wrapper_table = $('.mibok-modal .modal-wrapper-info').height();
        if(table > wrapper_table)
            $('.mibok-modal .modal-wrapper-info').perfectScrollbar('update');
        else
            $('.mibok-modal .modal-wrapper-info').perfectScrollbar('destroy');

        if($('.modal-footer-admin .modal-wrapper-info').length > 0)
        {
            var table= $('.modal-footer-admin .modal-wrapper-info .table').height();
            var wrapper_table = $('.modal-footer-admin .modal-wrapper-info').height();
            if(table > wrapper_table)
                $('.modal-footer-admin .modal-wrapper-info').perfectScrollbar();
        }
        
    })
    $('#mibok-timetableModal').on('hide.bs.modal', function (e) {
        $('.item-lesson.emitate-hover').removeClass('emitate-hover');
        //$('#mibok-timetableModal').find('.modal-content').removeClass('green blue yellow violet orange');
        $("body").css({'padding-right': "0", 'overflow-y': "auto"});
        
        
        var elem_id = $(this).find('input[name=AJAX_COUNTER_ELEMENT_ID]').val();
        var elem_tmstmp = $(this).find('input[name=AJAX_COUNTER_TMSTMP]').val();
        var count_rasp = $('.item-lesson[data-id=' + elem_id + '][data-tmstmp=' + elem_tmstmp + ']').find('.count-rasp');
        if(count_rasp.length > 0)
        {
            var page = $('input[name=TIMETABLE_AJAX]').val();
            var time_info = $(this).find('input[name=AJAX_COUNTER_TIME_INFO]').val();
            var iblock = $(this).find('input[name=AJAX_COUNTER_IBLOCK_ID]').val();
            
            $.ajax({
                type: "POST",
                url: page,
                //async: false,
                dataType: 'json',
                data: {ELEMENT_ID:elem_id, IBLOCK_ID: iblock, TIME_INFO: time_info, ACTION:'GetLimitOne'},
                success: function(data){
                    count_rasp.addClass(data['class']).html(data['table'] + '/' + data['iblock']);
                    if(data['class'] == '')
                        count_rasp.removeClass('no-item-record');
                }
            });
        }
        
    })
    $('#mibok-timetableModal').on('hidden.bs.modal', function (e) {
        $('#mibok-timetableModal').find('.modal-content').removeClass('green blue yellow violet orange');
    });

    var widthContentRasp = $('.mibok-wrapper-grid ').width();
    var sync1 = $(".mibok-carousel-day"),
        sync2 = $(".mibok-carousel-lessons"),
        flag = false,
        duration = 250;
    
    if(widthContentRasp >= 990)
    {
        sync1
            .owlCarousel({
                loop:false,
                margin:0,
                nav:true,
                navText:['', ''],
                //mouseDrag:false,
                responsive:{
                    0:{
                        items:1
                    },
                    330:{
                        items:2
                    },
                    480:{
                        items:3
                    },
                    630:{
                        items:4
                    },
                    768:{
                        items:7
                    }
                }
            })
            .on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;
                    sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            })
            ;

        sync2
            .owlCarousel({
                loop:false,
                margin:0,
                nav:false,
                //mouseDrag:false,
                responsive:{
                    0:{
                        items:1
                    },
                    330:{
                        items:2
                    },
                    480:{
                        items:3
                    },
                    630:{
                        items:4
                    },
                    768:{
                        items:7
                    }
                },
                onInitialized : callbackBorder
            })
            .on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;		
                    sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            })
            ;
        }
        else
        {
            var countSlider = widthContentRasp / 138;
            sync1
            .owlCarousel({
                loop:false,
                margin:0,
                nav:true,
                navText:['', ''],
                items:Math.floor(countSlider),
            })
            .on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;
                    sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            });

        sync2
            .owlCarousel({
                loop:false,
                margin:0,
                nav:false,
                items:Math.floor(countSlider),
                onInitialized : callbackBorder
            })
            .on('changed.owl.carousel', function (e) {
                if (!flag) {
                    flag = true;		
                    sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                    flag = false;
                }
            });
        }
        function callbackBorder(event)
        {
            $('.mibok-carousel-lessons .owl-item').each(function(indx, element){
                if( $(element).children().hasClass('day-current') && $(element).next().children().hasClass('day-past') 
                    || $(element).children().hasClass('day-current') && $(element).next().children().hasClass('day-future')   
                    || $(element).children().hasClass('day-no') && $(element).next().children().hasClass('day-past')   
                    || $(element).children().hasClass('day-no') && $(element).next().children().hasClass('day-future'))
                {
                        //$(element).next().find().css('border-left', '1px solid transparent');
                        $(element).next().find('.item').css('border-left', 'none');
                }
            })
        }
});

$(document)
    .on('click', '.admin-record-cancel', function(){
        var page = $('input[name=TIMETABLE_AJAX]').val();
        var id_tbl = $(this).attr('data-recordtbl');
        var id_iblock = $(this).attr('data-recordiblock');
        var tr = $(this).parents('tr');
        var elem_id = $(this).find('input[name=AJAX_COUNTER_ELEMENT_ID]').val();
        var elem_tmstmp = $(this).find('input[name=AJAX_COUNTER_TMSTMP]').val();
         var count_rasp = $('.item-lesson[data-id=' + elem_id + '][data-tmstmp=' + elem_tmstmp + ']').find('.count-rasp');
        $('.modal-footer-admin').remove('.alert');
        $.ajax({
                type: "POST",
                url: page,
                //async: false,
                dataType: 'json',
                data: {ID_TBL:id_tbl, ID_IBLOCK:id_iblock, ACTION:'CancelRecord'},
                success: function(data){
                    if(data['success'] == 'ok')
                    {
                        tr.remove();
                        $('.modal-footer-admin table').find('tr:not(.tr-add-admin)').each(function(ind, elem){
                            $(elem).find('td:first-child').html(ind+1);
                        })

                        if($('.modal-footer-admin [name=admin-limit-info]').length > 0 && $('.modal-footer-admin [name=admin-limit-info]').val() != '')
                        {
                            if($('.modal-footer-admin [name=admin-limit-info]').val() > $('.modal-footer-admin table').find('tr:not(.tr-add-admin)').length)
                                $('.modal-footer-admin table').find('.tr-add-admin').removeClass('hidden')
                        }
                    }
                    else if(data['success'] == 'error')
                    {
                        tr.parents('.modal-wrapper-info').before('<div class="alert alert-danger">ERROR DELETE</div>')
                    }
                }
            });
        return false;
    })
    .on('click', '.admin-show-comment', function(){
        $(this).next('textarea').removeClass('hidden');
        $(this).remove();
        return false;
    })
    .on('click', '.admin-record-add', function(){
        var page = $('input[name=TIMETABLE_AJAX]').val();
        var time_info = $('#mibok-timetableModal input[name=AJAX_COUNTER_TIME_INFO]').val();
        var elem_id = $('#mibok-timetableModal input[name=AJAX_COUNTER_ELEMENT_ID]').val();
        var tr = $(this).parents('tr');
        var comment = tr.find('textarea').val();
        $('.modal-footer-admin').remove('.alert');
        $.ajax({
            type: "POST",
            url: page,
            //async: false,
            dataType: 'json',
            data: {ELEMENT_ID:elem_id,  TIME_INFO: time_info, COMMENT:comment, ACTION:'AddRecordAdmin'},
            success: function(data){
                if(data['success'] == 'ok')
                {
                    var trLeng = $('.modal-footer-admin table').find('tr:not(.tr-add-admin)').length;
                    tr.before('<tr><td>'+ (trLeng+1) +'</td><td>' + data['td-info'] + comment + '</td><td>' + data['td-btn'] + '</td></tr>')
                    tr.find('textarea').val('');
                    
                    if($('.modal-footer-admin .alert').length > 0)
                        $('.modal-footer-admin .alert').remove();
                    
                    $('.modal-footer-admin .modal-wrapper-info').perfectScrollbar();
                }
                else if(data['success'] == 'error')
                {
                    tr.parents('.modal-wrapper-info').before('<div class="alert alert-danger">ERROR BLOCK</div>')
                }

                if($('.modal-footer-admin [name=admin-limit-info]').length > 0 && $('.modal-footer-admin [name=admin-limit-info]').val() != '')
                {
                    if($('.modal-footer-admin [name=admin-limit-info]').val() <= $('.modal-footer-admin table').find('tr:not(.tr-add-admin)').length)
                        tr.addClass('hidden')
                }
            }
        });
        return false;
    });

$(window).scroll(function() { 
    if($('.changebtstrp').length <= 0 && $('.mibok-wrapper-grid').length > 0)
    {
        var sliderTop = $('.mibok-wrapper-grid ').offset().top;
        var the_top = jQuery(document).scrollTop();
        var sliderBot = $('.mibok-border-bottom').offset().top;

        if (the_top > sliderTop && the_top < sliderBot) {
            $('.mibok-grid-bg').removeClass('hidden').addClass('fixed');
        }
        else if(the_top >= sliderBot){
            $('.mibok-grid-bg').addClass('hidden').removeClass('fixed');
        }
        else{
            $('.mibok-grid-bg').removeClass('fixed hidden');
        }
    }
});


function MibokCheckSubmit()
{
    var count = $('#mibok-timetableModal *[data-req]').length;
    var countEach = 0;
    $('#mibok-timetableModal *[data-req]').each(function (ind, el)
    {
        if($(el).val() != '')
            countEach++;
    })

    if($('.main-user-consent-request input[type=checkbox]').length > 0)
    {
        if(countEach == count && $('.main-user-consent-request input[type=checkbox]:checked').length > 0)
            $('.mibok-form-submit').removeAttr('disabled');
        else
            $('.mibok-form-submit').attr('disabled', 'disabled');
    }
    else
    {
        if(countEach == count)
            $('.mibok-form-submit').removeAttr('disabled');
        else
            $('.mibok-form-submit').attr('disabled', 'disabled');
    }
}