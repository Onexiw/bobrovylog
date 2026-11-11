<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$lm = GetMessage("rejim");
$APPLICATION->SetTitle($lm);

//$APPLICATION->SetTitle("Режим работы объектов");
?>
<div class="schedule">
	
	<div class="schedule__title">
		<h1><?=GetMessage("rejim")?></h1>
	</div>
	
	<div class="clear"></div>
	
<?$APPLICATION->IncludeComponent(
	"mx_mibok:rasp.timetable", 
	"mx_raspisanie", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
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
		"USE_FILTER" => "N",
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

</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>