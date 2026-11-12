<?if($curPage != '/index.php'):?>    <div class="clear"></div>
    <div class="also">
        <div class="row">
            <div class="also_zima">
                <div class="also__title col-xs-12 col-md-3"><?=GetMessage('winter_activities')?></div>
                <div class="also__list col-xs-12 col-md-8">

                    <?
                    GLOBAL $arrFilter;
                    $arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" ); ?>

                    <?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex_also", Array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                        "AJAX_MODE" => "N",	// Включить режим AJAX
                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                        "CACHE_GROUPS" => "N",	// Учитывать права доступа
                        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                        "CACHE_TYPE" => "A",	// Тип кеширования
                        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                        "DISPLAY_DATE" => "Y",	// Выводить дату элемента
                        "DISPLAY_NAME" => "Y",	// Выводить название элемента
                        "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                        "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                        "FIELD_CODE" => array(	// Поля
                            0 => "DETAIL_PICTURE",
                            1 => "",
                        ),
                        "FILTER_NAME" => "arrFilter",	// Фильтр
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                        "IBLOCK_ID" => "3",	// Код информационного блока
                        "IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                        "NEWS_COUNT" => "2",	// Количество новостей на странице
                        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                        "PAGER_TITLE" => "Новости",	// Название категорий
                        "PARENT_SECTION" => "",	// ID раздела
                        "PARENT_SECTION_CODE" => "",	// Код раздела
                        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                        "PROPERTY_CODE" => array(	// Свойства
                            0 => "MAIN_TITLE",
                            1 => "PHOTOS",
                            2 => "SERVICES",
                            3 => "SVG_MAIN_TITLE",
                            4 => "ROUND_PICT",
                            5 => "NAME_ENG",
                            6 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                        "SET_STATUS_404" => "N",	// Устанавливать статус 404
                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                        "SHOW_404" => "N",	// Показ специальной страницы
                        "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                        "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                        "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                        "COMPONENT_TEMPLATE" => ".default"
                    ),
                        false
                    );?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="also_leto">
                <div class="also__title col-xs-12 col-md-3"><?=GetMessage('summer_activities')?></div>
                <div class="also__list col-xs-12 col-md-8">
                    <?
                    GLOBAL $arrFilter;
                    $arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" ); ?>

                    <?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex_also", Array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                        "AJAX_MODE" => "N",	// Включить режим AJAX
                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                        "CACHE_GROUPS" => "N",	// Учитывать права доступа
                        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                        "CACHE_TYPE" => "A",	// Тип кеширования
                        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                        "DISPLAY_DATE" => "Y",	// Выводить дату элемента
                        "DISPLAY_NAME" => "Y",	// Выводить название элемента
                        "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                        "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                        "FIELD_CODE" => array(	// Поля
                            0 => "DETAIL_PICTURE",
                            1 => "",
                        ),
                        "FILTER_NAME" => "arrFilter",	// Фильтр
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                        "IBLOCK_ID" => "3",	// Код информационного блока
                        "IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                        "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
                        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                        "NEWS_COUNT" => "2",	// Количество новостей на странице
                        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                        "PAGER_TITLE" => "Новости",	// Название категорий
                        "PARENT_SECTION" => "",	// ID раздела
                        "PARENT_SECTION_CODE" => "",	// Код раздела
                        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                        "PROPERTY_CODE" => array(	// Свойства
                            0 => "MAIN_TITLE",
                            1 => "PHOTOS",
                            2 => "SERVICES",
                            3 => "SVG_MAIN_TITLE",
                            4 => "ROUND_PICT",
                            5 => "",
                            6 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                        "SET_STATUS_404" => "N",	// Устанавливать статус 404
                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                        "SHOW_404" => "N",	// Показ специальной страницы
                        "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                        "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                        "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                        "COMPONENT_TEMPLATE" => ".default"
                    ),
                        false
                    );?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?endif?>

<?if($curPage != '/events/index.php'):?>

    <?if(LANGUAGE_ID != "en"):?>
        <div class="events">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 event__head">
                        <div class="event__head__title">События</div>
                        <a href="/events/" class="event__head__link">Смотреть все</a>
                    </div>
                </div>
                <div class="row">

                    <?
                    GLOBAL $eventFilter;
                    $eventFilter['>=PROPERTY_DATE'] = date('Y-m-d');
                    ?>

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "mx_events",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "Y",
                            "CACHE_GROUPS" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "N",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "DETAIL_TEXT",
                                1 => "DETAIL_PICTURE",
                                2 => "",
                            ),
                            "FILTER_NAME" => "eventFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "6",
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "99",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "DATE",
                                1 => "",
                                2 => "",
                                3 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "property_DATE",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "COMPONENT_TEMPLATE" => "mx_events"
                        ),
                        false
                    );?>
                </div>
            </div>

        </div>

    <?endif// eng?>
<?endif?>

<div class="lazyload footer" data-src="<?=SITE_TEMPLATE_PATH?>/images/bg_footer.jpg">

    <?if($APPLICATION->GetCurPage() != "/" && $curPage != '/events/index.php'):?>
        <div class="footer__triangle_block">
            <img data-src="<?=SITE_TEMPLATE_PATH?>/images/triangle_blue.svg" class="lazyload footer__triangle">
        </div>
    <?endif?>

    <?if($APPLICATION->GetCurPage() == "/"):?>
        <div class="schedule schedule_main">
            <div class="schedule_light_blue__triangle_wrapper">
                <div class="schedule_light_blue__triangle_block"></div>
                <img data-src="<?=SITE_TEMPLATE_PATH?>/images/triangle_light_blue.svg" class="lazyload schedule_light_blue__triangle">
            </div>

            <div class="schedule__triangle_wrapper">
                <div class="schedule__triangle_block">
                    <img data-src="<?=SITE_TEMPLATE_PATH?>/images/triangle_blue.svg" class="lazyload schedule__triangle">
                </div>
            </div>

            <div class="schedule__title">
                <h1><?=GetMessage("rejim_br")?></h1>
            </div>

            <div class="clear"></div>
            <?$APPLICATION->IncludeComponent(
                "mx_mibok:rasp.timetable",
                "mx_raspisanie_main",
                array(
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "COMPONENT_TEMPLATE" => "mx_raspisanie",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FILTER_ALL_VALUE" => array(
                        0 => "0",
                    ),
                    "FILTER_MAIN_HEADER" => "0",
                    "EVENT_MESSAGE_ID" => "30",
                    "FILTER_NAME" => "arrMibokTt",
                    "IBLOCK_ID" => "10",
                    "IBLOCK_TYPE" => "s1_rasp",
                    "IBLOCK_ID_RECORD" => "9",
                    "IBLOCK_TYPE_RECORD" => "s1_rasp",
                    "IS_BOOTSTRAP_CSS" => "N",
                    "IS_BOOTSTRAP_JS" => "N",
                    "IS_OWL_CSS" => "Y",
                    "IS_OWL_JS" => "Y",
                    "IS_PS_CSS" => "Y",
                    "IS_PS_JS" => "Y",
                    "LIST_SETTINGS_MODAL_FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "",
                    ),
                    "LIST_SETTINGS_MODAL_NAME" => "NAME",
                    "LIST_SETTINGS_MODAL_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "LIST_SETTINGS_NAME" => "NAME",
                    "LIST_SETTINGS_PROP1" => "0",
                    "LIST_SETTINGS_PROP2" => "0",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "",
                    "SET_TITLE" => "Y",
                    "USE_FILTER" => "Y",
                    "USE_PERMISSIONS" => "N",
                    "PROPERTY_CODES_RECORD" => array(
                        0 => "47",
                        1 => "48",
                        2 => "NAME",
                    ),
                    "PROPERTY_CODES_RECORD_REQUIRED" => array(
                        0 => "47",
                        1 => "48",
                    ),
                    "SEF_MODE" => "Y",
                    "SEF_FOLDER" => "/rasp/",
                    "USER_CONSENT" => "N",
                    "USER_CONSENT_ID" => "0",
                    "USER_CONSENT_IS_CHECKED" => "Y",
                    "USER_CONSENT_IS_LOADED" => "N",
                    "CHANGE_BOOTSTRAP" => "N",
                    "IS_BOOTSTRAP_DP_JS" => "Y",
                    "IS_BOOTSTRAP_DP_CSS" => "Y",
                    "SIGN_HEAD" => "Расписание",
                    "SIGN_RECORD" => "Записаться",
                    "SIGN_FILTER" => "К сожалению, в расписании пока ничего нет по данным параметрам фильтра",
                    "SIGN_NO_DAY" => "Нет данных",
                    "FILTER_DATE_RANGE" => "Y"
                ),
                false
            );?>


            <?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_raspisanie_alerts", Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                "AJAX_MODE" => "N",	// Включить режим AJAX
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                "CACHE_GROUPS" => "N",	// Учитывать права доступа
                "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                "DISPLAY_DATE" => "Y",	// Выводить дату элемента
                "DISPLAY_NAME" => "Y",	// Выводить название элемента
                "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                "FIELD_CODE" => array(	// Поля
                    0 => "NAME",
                    1 => "DETAIL_TEXT",
                    2 => "",
                ),
                "FILTER_NAME" => "",	// Фильтр
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                "IBLOCK_ID" => "20",	// Код информационного блока
                "IBLOCK_TYPE" => "s1_rasp",	// Тип информационного блока (используется только для проверки)
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
                "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                "NEWS_COUNT" => "999999",	// Количество новостей на странице
                "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                "PAGER_TITLE" => "Новости",	// Название категорий
                "PARENT_SECTION" => "",	// ID раздела
                "PARENT_SECTION_CODE" => "",	// Код раздела
                "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                "PROPERTY_CODE" => array(	// Свойства
                    0 => "DATE",
                    1 => "OBJECT",
                ),
                "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                "SET_STATUS_404" => "N",	// Устанавливать статус 404
                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                "SHOW_404" => "N",	// Показ специальной страницы
                "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
                "SORT_BY2" => "NAME",	// Поле для второй сортировки новостей
                "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                "COMPONENT_TEMPLATE" => ".default"
            ),
                false
            );?>
        </div><!--//schedule-->
    <?endif?>

    <div class="footer__big">
        <img data-src="<?=SITE_TEMPLATE_PATH?>/images/footer_big.svg" class="lazyload footer__big__desktop">
        <img data-src="<?=SITE_TEMPLATE_PATH?>/images/footer_small.svg" class="lazyload footer__big__mobile">
    </div>

    <div class="footer__bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-5">
                    <div class="footer__bottom__address">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/address".$lng.".php"
                            )
                        );?>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-7">
                            <?if($lng != 'en'):?>
                                <form action="/search/" method="post" class="footer__bottom__form">
                                    <input type="text" class="footer__bottom__search" id="footer__bottom__search" placeholder="Поиск по сайту" name="q"><label for="footer__bottom__search"></label>
                                </form>
                            <?endif?>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-5">
                            <a href="/about/contacts/" class="footer__bottom__scheme"><?=GetMessage("scheme")?></a>
                        </div>
                    </div>
                </div>
            </div>

            <p class="col-xs-12 col-md-5" style="color: #fff;margin-left: -15px; margin-top: 15px;">
               
            </p>


        </div>
    </div>

</div><!--//footer-->

<div class="header">
    <div class="header__menu collapse" id="header_menu">
        <div class="header__menu__block">
            <?//d($_COOKIE["language"])?>

            <div class="header__menu__block__center">

                <div class="switch">
                    <div class="switch__handle"></div>
                    <div class="switch__zima"><?=GetMessage("zima")?></div>
                    <div class="switch__leto"><?=GetMessage("leto")?></div>
                </div>

                <div class="desktop_menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "mx_top_menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => GetMessage("left_menu"),	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "3",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => GetMessage("top_menu"),	// Тип меню для первого уровня
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    );?>
                </div>
                <div class="mobile_menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "mx_top_menu_m", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => GetMessage("left_menu"),	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "3",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => GetMessage("top_menu"),	// Тип меню для первого уровня
                        "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    );?>
                </div>

            </div>
			<div class="container_tbank">
                <a href="https://market.bobrovylog.ru/?erid=2RanymZDkh6" class="link_tbank"><img alt="Кэшбэк 10% Т-Банк*" src="/images/tbank-cashback-legacy.svg"></a>
				<a href="https://market.bobrovylog.ru/?erid=2RanymZDkh6" class="link_tbank_mobile"><img alt="Кэшбэк 10% Т-Банк*" src="/images/tbank-cashback-legacy.svg"></a>
            </div>

            <div class="header__menu__block__info">
                <div class="row">
                    <div class="col-xs-6 col-md-12">
                        <?
                        //global $USER;
                        //if ($USER->IsAdmin()):?>
 <button 
    class="header__menu__block__info__skipass ticket-btn" 
    onclick="WPOpenModal({
                        id: 537,
						//groupid: 20214214,  
						onnlytab: ['service', 'rewrite'],
						forcetab: 'rewrite',
                        height: 700,
                        width: 1200,
                        type: 'modal',
                        nopromo: true,
                        locale: 'ru'
			}); return false;">
    <?= (LANGUAGE_ID == 'en') ? 'BUY TICKET' : 'КУПИТЬ БИЛЕТ' ?>
</button>


                       <!-- <?if(LANGUAGE_ID == 'en'):?>
                            <a href="https://market.bobrovylog.ru" class="header__menu__block__info__skipass" target="_blank">SHOP</a>
                        <?endif?>

                        <?if(LANGUAGE_ID == 'ru'):?>
                            <a href="https://market.bobrovylog.ru" class="header__menu__block__info__skipass" target="_blank">МАГАЗИН</a>
                        <?endif?>


                        <?//endif?>-->
                    </div>
                    <div class="col-xs-6 visible-xs">
                        <div class="lang">
                            <a href="" class="lang_ru <?=$lng == 'ru' ? 'active' : ''?>">RU</a>
                            <a href="" class="lang_en <?=$lng == 'en' ? 'active' : ''?>">ENG</a>
                        </div>
                    </div>
                </div>

                <div class="header__menu__block__info__title"><?=GetMessage("info_service")?></div>
                <div class="header__menu__block__info__contact">
                    <a href="tel:<?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/phone.php"
                        )
                    );?>" class="header__menu__block__info__contact__phone">
                        <span class="header__menu__block__info__contact__phone__icon"></span>
                        <span class="header__menu__block__info__contact__phone__text"><?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/phone.php"
                                )
                            );?></span>
                    </a>

                    <a href="mailto:<?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/email.php"
                        )
                    );?>" class="header__menu__block__info__contact__email">
                        <span class="header__menu__block__info__contact__email__icon"></span>
                        <span class="header__menu__block__info__contact__email__text"><?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/email.php"
                                )

                            );?></span>

                    </a>










                    <div class="clear"></div>
                </div>
            </div>

            <div class="header__menu__block__info__rules_wrapper">
                <a href="/pravila-fanparka/" class="header__menu__block__info__rules">
                    <?=GetMessage("rules")?>
                </a>

            </div>

            <div class="clear"></div>
        </div>
    </div>

    <a class="header__button collapsed" data-toggle="collapse" href="#header_menu" aria-expanded="false" aria-controls="header_menu">
        <span class="header__button__open"></span>
        <span class="header__button__close"></span>
    </a>

    <?if($APPLICATION->GetCurPage() == "/"):?>
        <?$link = "#top";?>
    <?else:?>
        <?$link = "/";?>
    <?endif?>

    <a href="<?=$link?>" class="header__logo noscroll"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.svg" class="header__logo__img"></a>
    <a href="<?=$link?>" class="header__title noscroll">
        <div class="header__title__svg"></div>
    </a>

    <div class="header__tempr" onclick="openWeatherModal()">
        <div class="header__tempr__value">
            <?
            //echo file_get_contents( "http://old.bobrovylog.ru/temper/degree.txt" ).'&#176;';
            //echo file_get_contents( "http://62.213.48.135/temper/degree.txt" ).'&#176;';
            echo '&#176;';
            ?>
        </div>
    </div>

    <!-- Модальное окно -->
<div id="weatherModal" class="weather-modal">
    <div class="weather-modal-content">
        <!-- Виджет погоды -->
        <a id="ms-informer-link-5cd22d41041c5d92053a102b938e0685" class="ms-informer-link" href="https://www.meteoservice.ru/weather/overview/krasnoyarsk">Погода в Красноярске</a>
        <script class="ms-informer-script" src="https://www.meteoservice.ru/informer/script/5cd22d41041c5d92053a102b938e0685"></script>
        
        <!-- Кнопка закрытия -->
        <span class="close" onclick="closeWeatherModal()">×</span>
    </div>
</div>



</div><!--//header-->


<?if($lng != 'en'):?>

    <a class="lupa" data-toggle="modal" data-target="#search_modal">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2441 23.3867C18.7299 23.3867 23.1771 18.8993 23.1771 13.3638C23.1771 7.82836 18.7299 3.34096 13.2441 3.34096C7.7582 3.34096 3.31102 7.82836 3.31102 13.3638C3.31102 18.8993 7.7582 23.3867 13.2441 23.3867ZM13.2441 26.7277C20.5586 26.7277 26.4881 20.7445 26.4881 13.3638C26.4881 5.9832 20.5586 0 13.2441 0C5.92957 0 0 5.9832 0 13.3638C0 20.7445 5.92957 26.7277 13.2441 26.7277Z" fill="#E0E0E0"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M27.6588 30L21.0367 23.3181L23.378 20.9557L30 27.6376L27.6588 30Z" fill="#E0E0E0"/>
        </svg>
    </a>
<?endif?>

<div class="lang lang_desktop">
    <a href="" class="lang_ru <?=$lng == 'ru' ? 'active' : ''?>">RU</a>
    <a href="" class="lang_en <?=$lng == 'en' ? 'active' : ''?>">ENG</a>
</div>

<!--modal qna-->
<div class="modal fade" id="question" tabindex="-1" role="dialog">
    <div class="modal_block">
        <div class="modal_block__top">
            <div class="modal_block__top__title">Задать вопрос</div>
            <div class="modal_block__top__close" data-dismiss="modal">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                    <path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                    <path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
        <div class="modal_block__body">
            <form action="#" method="post" class="form_check form_style question_form">
                <p class="rline">
                    <input type="text" class="rfield question_form__name" name="name" placeholder="Имя" autocomplete="off"/>
                </p>
                <p class="rline">
                    <input type="text" class="rfield question_form__name phonefield" name="phone" placeholder="Телефон" autocomplete="off"/>
                </p>
                <p class="rline">
                    <input type="text" class="mailfield question_form__name" name="email" placeholder="E-mail" autocomplete="off"/>
                </p>
                <p class="rline">
                    <textarea class="rfield question_form__question" name="question" placeholder="Ваш вопрос"></textarea>
                </p>

                <input type="hidden" name="phrase">

                <p class="rline rcheck">
                    <input type="checkbox" class="rfield" id="check_2" checked="checked"/>
                    <label for="check_2">В соответствии с Федеральным законом «О персональных данных» от 27.07.2006 N 152-ФЗ свободно, своей волей и в своем интересе я даю свое согласие ООО «Ренонс» (Фанпарк «Бобровый лог») на обработку моих персональных данных, указанных при заполнении формы обратной связи на сайте www.bobrovylog.ru</label>
                </p>

                <div class="service_form__submit">
                    <input type="hidden" id="hash" name="hash" value="<?=md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].intval(time()/20000));?>" />
                    <button type="submit" class="btnsubmit">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--modal search-->
<div class="modal fade" id="search_modal" tabindex="-1" role="dialog">
    <div class="search_modal__block">
        <form action="/search/" method="post" class="search_modal__block__form">
            <input type="text" class="search_modal__block__form__search" id="modal_search" placeholder="Поиск по сайту" name="q">
            <input type="submit" class="modal_search__submit" value="Поиск">
            <div class="modal_search__close" data-dismiss="modal"><svg id="closer" viewBox="0 0 32 32" width="100%" height="100%">
                    <path d="M1.421 32c-0.365 0-0.73-0.141-1.005-0.416-0.557-0.55-0.557-1.446 0-2.003l13.632-13.581-13.632-13.581c-0.557-0.55-0.557-1.446 0-2.003s1.453-0.55 2.010 0l14.637 14.586c0.269 0.269 0.416 0.627 0.416 0.998s-0.147 0.736-0.416 0.998l-14.637 14.586c-0.282 0.275-0.64 0.416-1.005 0.416zM30.579 32c-0.365 0-0.73-0.141-1.005-0.416l-14.63-14.586c-0.269-0.269-0.416-0.627-0.416-0.998s0.147-0.736 0.416-0.998l14.63-14.586c0.557-0.55 1.453-0.55 2.010 0s0.557 1.446 0 2.003l-13.632 13.581 13.632 13.581c0.557 0.55 0.557 1.446 0 2.003-0.282 0.275-0.64 0.416-1.005 0.416z"></path>
                </svg></div>
        </form>
    </div>
</div>


<!--modal webcam-->
<div class="modal fade" id="webcam" tabindex="-1" role="dialog">

    <div class="modal_webcam">
        <div class="theoplayer-container video-js theoplayer-skin"></div>

    </div>

    <div class="modal_block__top__close" data-dismiss="modal">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            <path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            <path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>






<!--modal webcam wowza-->
<div class="modal fade" id="webcam_wowza" tabindex="-1" role="dialog">

    <div class="modal_webcam">

        <div id="playerElement" style="width:100%; height:0; padding:0 0 56.25% 0"></div>


    </div>

    <div class="modal_block__top__close" data-dismiss="modal">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            <path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            <path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>






<!--modal оплата-->
<div class="modal fade" id="skipass_modal" tabindex="-1" role="dialog">
    <div class="skipass_block">







        <div class="success_block__close" data-dismiss="modal">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                <path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                <path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>

    </div>
</div>






<!--modal success-->
<div class="modal fade" id="success" tabindex="-1" role="dialog">
    <div class="success_block">
        <div class="success_block__picture">
            <svg width="84" height="83" viewBox="0 0 84 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M73.5002 14.4688L11.6179 32.5876C6.49882 34.0939 5.37721 40.7752 9.7422 43.8672L23.2876 53.5225L20.7102 64.4317C19.2932 70.4291 26.4737 74.7322 31.1939 70.8117L38.7428 64.5298L52.0071 73.9686C52.7075 74.4616 53.484 74.8088 54.2971 75.0009C55.3725 75.255 56.4989 75.2345 57.5814 74.9308C59.48 74.3967 61.0249 73.0149 61.7694 71.212L81.3837 23.0048C83.4083 18.0107 78.6455 12.9687 73.5002 14.4688ZM27.0051 65.9189L28.9779 57.5691L33.3166 60.6548L27.0051 65.9189ZM55.7629 68.7966L37.532 55.8235L62.0964 34.0192C63.973 32.3473 61.8736 29.3948 59.6357 30.5447L26.2704 47.8132L13.495 38.7082L75.3804 20.5766L55.7629 68.7966Z" fill="#6C9ABF"/>
            </svg>
        </div>
        <div class="success_block__text">
            Спасибо!<br>
            Ваша заявка принята!
        </div>

        <div class="success_block__close" data-dismiss="modal">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                <path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
                <path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>

    </div>
</div>





<?if(!isset($_COOKIE["cookiePolicy"])) {
    $cookie_warning = 'opened';
} else {
    $cookie_warning = '';
}
?>
<div class="cookie <?=$cookie_warning?>">
    <div class="cookie__blue">
        <?//d($_COOKIE)?>
        <div class="cookie__close">
            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5 30C7.45228 30 1 23.5477 1 15.5C1 7.45228 7.45228 1 15.5 1C23.5477 1 30 7.45228 30 15.5C30 23.5477 23.5477 30 15.5 30Z" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M8.99545 8.98959L22.0059 22" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
                <path d="M22.0045 8.98959L8.99414 22" stroke="white" stroke-width="2" stroke-miterlimit="10"/>
            </svg>
        </div>

        <div class="cookie__blue__block">
            <div class="cookie__blue__block__text">
                <?=GetMessage("cookies_info")?>
            </div>

            <a href="" class="cookie__blue__block__link"><?=GetMessage("accept")?></a>

        </div>
    </div>
</div>









</div><!--//.wrapper-->
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(54361693, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });

<!-- Модальное окно погоды на мобилке-->
    function openWeatherModal() {
        document.getElementById('weatherModal').style.display = 'block';
    }

    function closeWeatherModal() {
        document.getElementById('weatherModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('weatherModal')) {
            closeWeatherModal();
        }
    }

</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54361693" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>