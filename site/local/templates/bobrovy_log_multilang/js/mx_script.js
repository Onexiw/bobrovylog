//проверка на ботов
function empty_form() {
    $('input[name=phrase]').val('megasecret');
}

$(document).ready(function () {

    //переключаем язык
    //$.removeCookie("language");
    //$.removeCookie("language", { path: '/'});
    //switching language
    $('body').delegate('.lang_en', 'click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        //console.log('sl');
        $('.lang_ru').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('ru').addClass('en');
        $.cookie("language", 'en', {path: '/'});
        //location.reload();
        var page_path = window.location.pathname;
        location.href = page_path + '?lng=en';

        //console.log(urrl+page_path);

//		location.href = 'https://bobrovylog.ru/?lng=en';
        //return false;
    });
    //switching language
    $('body').delegate('.lang_ru', 'click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        //console.log('en');
        $('.lang_en').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('en').addClass('ru');
        $.cookie("language", 'ru', {path: '/'});
        //location.reload();

        var page_path = window.location.pathname;
        //console.log(urrl+page_path);
        location.href = page_path;


//		location.href = 'https://bobrovylog.ru/';
        //return false;
    });


    $.ajax({
        type: 'POST',
        url: '/include/ajax_t.php',
        success: function (result) {
            $('.vidget__tempr__value').html(result);
            $('.header__tempr__value').html(result);
        }
    });

    function noscroll() {
        if ($(window).scrollTop() > 0) {
            $('.header__logo').removeClass('noscroll');
            $('.header__title').removeClass('noscroll');
        } else {
            $('.header__logo').addClass('noscroll');
            $('.header__title').addClass('noscroll');
        }
    }

    noscroll();

    $(window).scroll(function () {
        noscroll();
    });


    //$.cookie("cookiePolicy", "Y");
    $('.cookie__blue__block__link').on('click', function (e) {
        e.preventDefault();
        $.cookie('cookiePolicy', 'y', {path: '/', expires: 365});
        console.log($.cookie('cookiePolicy'));
        $('.cookie').removeClass("opened");
    });


    //закрываем куки полиси
    $('.cookie__close').on('click', function (e) {
        e.preventDefault();
        $.cookie('cookiePolicy', 'y', {path: '/', expires: 365});
        $('.cookie').removeClass("opened");
    });

    //console.log($.cookie("cookiePolicy"));

    //применяем фильтр событий
    $('.event_filter__action').on('click touchend', function (e) {
        e.preventDefault();
        var filY = $('#dropdown_year').attr('cur');
        var filM = $('#dropdown_month').attr('cur');

        console.log(filY);
        console.log(filM);

        $.ajax({
            type: 'POST',
            url: '/include/ajax_event_filter.php',
            data: {
                year: filY,
                month: filM
            },
            success: function (result) {
                console.log(result);

                $('.event__list').html(result);
            }
        });

    });

    //выбираем каррент значение в дропдауне фильтра событий
    $('.event_filter__element').on('click touchstart', function () {
        var fvalue = $(this).text();
        $(this).parent().parent().find('.dropdown__current').html(fvalue + '<span class="caret"></span>').attr('cur', fvalue);
    });

    //dotdotdot
    $('.news_main__pair__item__info').dotdotdot({
        watch: "true",
    });

    $('.event_slider__item_wrapper').dotdotdot({
        watch: "true",
    });

    $('.event__item__cutblock').dotdotdot({
        watch: "true",
    });


    //включаем lazyload
    let images = document.querySelectorAll(".lazyload");
    lazyload(images);

    //плавный скролл к якорю (нужно добавить класс 'scroll' к нужной ссылке)
    $(function () {
        $("a.scroll").click(function () {
            var _href = $(this).attr("href");
            $("html, body").animate({scrollTop: $(_href).offset().top + "px"});
            return false;
        });
    });


    //все, что зависит от размера экрана
    function screensize() {

        var h = document.documentElement.clientHeight == 0 ? document.body.clientHeight : document.documentElement.clientHeight;
        var w = document.documentElement.clientWidth == 0 ? document.body.clientWidth : document.documentElement.clientWidth;

        //высота карты 100%
        $('.map').height(h);

        //смотрим высоту расписания на главной и делаем такую же высоту синего фона
        var rth = $('.rasp_title').height();
        var rh = $('.rasp_header').height();
        $('.schedule_light_blue__triangle_block').height(rth + rh);

        //высота .header 100% экрана на НЕ мобайл
        if (w >= 769) {
            if (h <= 575) {
                h = 575;
            }
            $('.header').height(h);
        } else {
            $('.header').height(65);
        }

        //высота главного слайдера 100% экрана на НЕ мобайл
        if (w >= 769) {
            $('.main_slider').height(h);
            $('.main_screen').height(h);
            $('.service__detail__slider').height(h);
            $('.service__detail__slider_simple').height(h);
            //$('.desktop_menu>ul>li>ul').height(h);

            $('.main_slider__nav_page').css('top', 'auto');

        } else {
            $('.main_slider').css('height', 'auto');
            $('.main_screen').height('height', 'auto');
            $('.service__detail__slider').css('height', 'auto');
            $('.service__detail__slider_simple').css('height', 'auto');
            //$('.desktop_menu>ul>li>ul').css('height','auto');

            var msm_h = $('.main_slider__mobile').height();
            $('.main_slider__nav_page').css('top', msm_h);
        }

        //высота header__menu 100% экрана на  мобайл
        if (w < 769) {
            $('#header_menu').height(h - 65);
        } else {
            $('#header_menu').css('height', 'auto');
        }


        $('#header_menu').on('shown.bs.collapse', function () {
            if (w < 769) {
                $('#header_menu').height(h - 65);
            } else {
                $('#header_menu').css('height', 'auto');
            }
        })


    }

    screensize();

    $(window).resize(function () {
        screensize();
    });


    //main slider zima
    var main_slider_zima = new Swiper('.main_slider_zima', {
        loop: true,
        autoplay: {
            disableOnInteraction:false,
        },
        speed: 800,
        pagination: {
            el: '.swiper-pagination_d',
        },
        navigation: {
            nextEl: '.slider_next',
            prevEl: '.slider_prev',
        },
        preloadImages: false,
        lazy: {
            loadPrevNext:true,
        }
    });


    //complex_slider
    var complex_slider_zima = new Swiper('.complex_slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination_c',
        },
        navigation: {
            nextEl: '.complex_next',
            prevEl: '.complex_prev',
        },
        preloadImages: false,
        lazy: true,
    });


    //event slider
    var event_slider = new Swiper('.event_slider', {
        loop: true,
        slidesPerView: 2,
        pagination: {
            el: '.swiper-pagination_e',
        },
        navigation: {
            nextEl: '.event_next',
            prevEl: '.event_prev',
        },
        preloadImages: false,
        lazy: true,
        breakpoints: {
            768: {
                slidesPerView: 1,
            },
        }
    });

    //serivce detail slider
    var service__detail__slider = new Swiper('.service__detail__slider', {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination_s',
        },
        autoplay: {
            disableOnInteraction:false,
        },
        speed: 800,
        navigation: {
            nextEl: '.service_next',
            prevEl: '.service_prev',
        },
        preloadImages: false,
        lazy: true,
    });


    //переключаем зима-лето
    $('.switch__zima').on('click touchend', function () {
        //$.removeCookie('color_theme', { path: '/'});
        $.cookie("color_theme", 'zima', {path: '/'});
        $('#header_menu').collapse('hide');
        location.reload();

    });

    $('.switch__leto').on('click touchend', function () {
        //$.removeCookie('color_theme', { path: '/'});
        $.cookie("color_theme", 'leto', {path: '/'});
        $('#header_menu').collapse('hide');
        location.reload();
    });

    //клик по лупе сабмитит поиск
    $('label[for=footer__bottom__search]').on('click touchstart', function () {
        $('.footer__bottom__form').submit();
    });


    //отправляем заявку из Услуг
    var count = 0;
    $('.service_form').on('submit', function (e) {
        e.preventDefault();
        empty_form();

        if (count == 1) {
            $.ajax({
                type: 'POST',
                url: '/include/service_form_handler.php',
                data: $('.service_form').serialize(),
                success: function (result) {
                    console.log(result);
                    $('#success').modal('show');
                }
            });
        }
        count++;
    });

    //отправляем заявку из Событий
    var count = 0;
    $('.events_form').on('submit', function (e) {
        e.preventDefault();
        empty_form();

        if (count == 1) {
            $.ajax({
                type: 'POST',
                url: '/include/event_form_handler.php',
                data: $('.events_form').serialize(),
                success: function (result) {
                    //console.log(result);
                    $('#success').modal('show');
                }
            });
        }
        count++;
    });


    //отправляем вопрос
    var count = 0;
    $('.question_form').on('submit', function (e) {
        e.preventDefault();
        empty_form();

        if (count == 1) {
            $.ajax({
                type: 'POST',
                url: '/include/question_form_handler.php',
                data: $('.question_form').serialize(),
                success: function (result) {
                    console.log(result);
                    $('#question').modal('hide');
                    $('#success').modal('show');
                }
            });
        }
        count++;
    });


});

document.addEventListener("DOMContentLoaded", function() {
    var lupaButton = document.querySelector(".lupa");
    var searchModal = document.querySelector("#search_modal");

    lupaButton.addEventListener("click", function() {
        // Открываем модальное окно
        searchModal.classList.add("show");
        searchModal.style.display = "block"; // Для Bootstrap Modal
        // Делаем активной строку поиска
        var inputSearch = searchModal.querySelector(".search_modal__block__form__search");
        if (inputSearch) {
            inputSearch.focus();
        }
    });
});