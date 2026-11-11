<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$lm = GetMessage("finpark_full");
$APPLICATION->SetTitle($lm);
//$APPLICATION->SetTitle("Фанпарк Бобровый лог");
?>

<?
//global $USER;
//if ($USER->IsAdmin()):?>

<div class="main_screen main_screen_zima">
	<div class="container-fluid">
		<div class="row">
			<div class="swiper-container main_slider main_slider_zima">
			
			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );			
				} else {
					$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );			
				}
			?>
				
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_main_slider", Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"AJAX_MODE" => "N",	// Включить режим AJAX
			"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
			"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
			"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
			"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
			"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
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
			"IBLOCK_ID" => "1",	// Код информационного блока
			"IBLOCK_TYPE" => "big_slider",	// Тип информационного блока (используется только для проверки)
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
			"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
			"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
			"NEWS_COUNT" => "200",	// Количество новостей на странице
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
				0 => "BIG_TEXT",
				1 => "SMALL_TEXT",
				2 => "LINK",
				3 => "PICTURE_MOBILE",
				4 => "BIG_TEXT_MOBILE",
				5 => "ZIMA"
			),
			"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
			"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
			"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
			"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
			"SET_STATUS_404" => "N",	// Устанавливать статус 404
			"SET_TITLE" => "N",	// Устанавливать заголовок страницы
			"SHOW_404" => "N",	// Показ специальной страницы
			"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
			"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
			"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
			"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
			"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	);?>
			<div class="vidget">
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/vidget.php"
	)
);?>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="complex">
	<div class="container-fluid">
		<div class="row">
			
			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );	?>
					
			<div class="complex_zima">
				
				<div class="complex_zima__big"><img src="<?=SITE_TEMPLATE_PATH?>/images/big_zima_words_<?=LANGUAGE_ID?>.svg"></div>
				<div class="complex_zima__big_text"><?=GetMessage('winter_activities')?></div>
					
							
				<?} else {
					$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );	?>		

			<div class="complex_leto">
				<div class="complex_leto__big"><img src="<?=SITE_TEMPLATE_PATH?>/images/big_leto_words_<?=LANGUAGE_ID?>.svg"></div>
				<div class="complex_leto__big_text"><?=GetMessage('summer_activities')?></div>

				<?}
			?>

			<?if($_SESSION["device"] == 'm'):?>
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex_noslider", Array(
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
						"NEWS_COUNT" => "200",	// Количество новостей на странице
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
							4 => "TEXT_ENG",
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
			<?else:?>
			
					<div class="swiper-container complex_slider">

		
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex", Array(
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
						"NEWS_COUNT" => "200",	// Количество новостей на странице
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
							4 => "TEXT_ENG",
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
			
			<?endif?>
				<div class="clear"><?=LANGUAGE_ID?></div>
			</div>
			
	
		</div>
	</div>
</div>



<?if(LANGUAGE_ID != "en"):?>
<div class="news_main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 news_main__head">
				<div class="news_main__head__title">Новости</div>
				<a href="/news/" class="news_main__head__link">Смотреть все</a>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="news_main__wrapper">
						
					<div class="news_main__big">

							<?
								GLOBAL $arrFilter;
								$arrFilter = array( "PROPERTY_FIX_VALUE" => "Y" ); 

								$APPLICATION->IncludeComponent(
									"bitrix:news.list", 
									"mx_news_main_big", 
									array(
										"ACTIVE_DATE_FORMAT" => "d.m.Y",
										"ADD_SECTIONS_CHAIN" => "N",
										"AJAX_MODE" => "N",
										"AJAX_OPTION_ADDITIONAL" => "",
										"AJAX_OPTION_HISTORY" => "N",
										"AJAX_OPTION_JUMP" => "N",
										"AJAX_OPTION_STYLE" => "Y",
										"CACHE_FILTER" => "N",
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
										"FILTER_NAME" => "arrFilter",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "4",
										"IBLOCK_TYPE" => "content",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "Y",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "1",
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
											0 => "",
											1 => "AUTHOR",
											2 => "FIX",
											3 => "PHOTOGRAPH",
											4 => "",
											5 => "",
											6 => "",
											7 => "",
											8 => "",
										),
										"SET_BROWSER_TITLE" => "N",
										"SET_LAST_MODIFIED" => "N",
										"SET_META_DESCRIPTION" => "N",
										"SET_META_KEYWORDS" => "N",
										"SET_STATUS_404" => "N",
										"SET_TITLE" => "N",
										"SHOW_404" => "N",
										"SORT_BY1" => "ACTIVE_FROM",
										"SORT_BY2" => "SORT",
										"SORT_ORDER1" => "DESC",
										"SORT_ORDER2" => "ASC",
										"STRICT_SECTION_CHECK" => "N",
										"COMPONENT_TEMPLATE" => "mx_news_main"
									),
									false
								);?>

						</div>	
							
					<div class="news_main__pair">
						<?
							GLOBAL $arrFilter;
								$arrFilter = array( "!PROPERTY_FIX_VALUE" => "Y" ); 
						?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mx_news_main", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
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
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
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
			0 => "",
			1 => "AUTHOR",
			2 => "FIX",
			3 => "PHOTOGRAPH",
			4 => "",
			5 => "",
			6 => "",
			7 => "",
			8 => "",
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
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mx_news_main"
	),
	false
);?>	
					</div><!--//news_main__pair-->
				
					<div class="clear"></div>
				</div>

			</div>
		</div>

		<div class="clear"></div>

		<div class="row">
			<div class="news_main__social">
				<div class="news_main__social__title">Мы в соцсетях</div>
				<div class="news_main__social__links">
					<div class="news_main__social__links__item">
						<a href="https://www.facebook.com/bobrovylog" class="news_main__social__links__item__icon item__icon_fb"></a>
					</div>
					<div class="news_main__social__links__item">
						<a href="https://vk.com/bobrovylog" class="news_main__social__links__item__icon item__icon_vk"></a>
					</div>
					<div class="news_main__social__links__item">
						<a href="https://www.instagram.com/bobrolog/" class="news_main__social__links__item__icon item__icon_inst"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?endif?>



<div class="main_service">
	<div class="container-fluid">
		<div class="row">

			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );	?>			
					<div class="main_service__block main_service__block_zima">
				<?} else {?>
					<?$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );	?>			
					<div class="main_service__block main_service__block_leto">

				<?}?>
			<?

				$APPLICATION->IncludeComponent("bitrix:news.list", "mx_podborka", Array(
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
						"IBLOCK_ID" => "5",	// Код информационного блока
						"IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
						"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
						"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
						"NEWS_COUNT" => "1",	// Количество новостей на странице
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
							0 => "ZIMA",
							1 => "SERVICES",
							2 => "",
							3 => "",
							4 => "",
							5 => "",
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

			
		</div>
	</div>
</div>












<?//else:?>

<?if($open = "закрываем старое на время"):?>




<div class="main_screen main_screen_zima">
	<div class="container-fluid">
		<div class="row">
			<div class="swiper-container main_slider main_slider_zima">
			
			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );			
				} else {
					$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );			
				}
			?>
				
	<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_main_slider", Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"AJAX_MODE" => "N",	// Включить режим AJAX
			"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
			"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
			"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
			"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
			"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
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
			"IBLOCK_ID" => "1",	// Код информационного блока
			"IBLOCK_TYPE" => "big_slider",	// Тип информационного блока (используется только для проверки)
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
			"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
			"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
			"NEWS_COUNT" => "200",	// Количество новостей на странице
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
				0 => "BIG_TEXT",
				1 => "SMALL_TEXT",
				2 => "LINK",
				3 => "PICTURE_MOBILE",
				4 => "BIG_TEXT_MOBILE",
				5 => "ZIMA"
			),
			"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
			"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
			"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
			"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
			"SET_STATUS_404" => "N",	// Устанавливать статус 404
			"SET_TITLE" => "N",	// Устанавливать заголовок страницы
			"SHOW_404" => "N",	// Показ специальной страницы
			"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
			"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
			"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
			"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
			"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	);?>
			<div class="vidget">
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/vidget.php"
	)
);?>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="complex">
	<div class="container-fluid">
		<div class="row">
			
			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );	?>
					
			<div class="complex_zima">
				
				<div class="complex_zima__big"><img src="<?=SITE_TEMPLATE_PATH?>/images/big_zima_words.svg"></div>
				<div class="complex_zima__big_text">Как отдохнуть этой зимой</div>
					
							
				<?} else {
					$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );	?>		

			<div class="complex_leto">
				<div class="complex_leto__big"><img src="<?=SITE_TEMPLATE_PATH?>/images/big_leto_words.svg"></div>
				<div class="complex_leto__big_text">Как отдохнуть этим летом</div>

				<?}
			?>

			<?if($_SESSION["device"] == 'm'):?>
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex_noslider", Array(
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
						"NEWS_COUNT" => "200",	// Количество новостей на странице
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
							4 => "",
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
			<?else:?>
			
					<div class="swiper-container complex_slider">

		
				<?$APPLICATION->IncludeComponent("bitrix:news.list", "mx_complex", Array(
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
						"NEWS_COUNT" => "200",	// Количество новостей на странице
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
							4 => "",
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
			
			<?endif?>
				<div class="clear"></div>
			</div>
			
	
		</div>
	</div>
</div>




<div class="news_main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 news_main__head">
				<div class="news_main__head__title">Новости</div>
				<a href="/news/" class="news_main__head__link">Смотреть все</a>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="news_main__wrapper">
						
					<div class="news_main__big">

							<?
								GLOBAL $arrFilter;
								$arrFilter = array( "PROPERTY_FIX_VALUE" => "Y" ); 

								$APPLICATION->IncludeComponent(
									"bitrix:news.list", 
									"mx_news_main_big", 
									array(
										"ACTIVE_DATE_FORMAT" => "d.m.Y",
										"ADD_SECTIONS_CHAIN" => "N",
										"AJAX_MODE" => "N",
										"AJAX_OPTION_ADDITIONAL" => "",
										"AJAX_OPTION_HISTORY" => "N",
										"AJAX_OPTION_JUMP" => "N",
										"AJAX_OPTION_STYLE" => "Y",
										"CACHE_FILTER" => "N",
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
										"FILTER_NAME" => "arrFilter",
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",
										"IBLOCK_ID" => "4",
										"IBLOCK_TYPE" => "content",
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
										"INCLUDE_SUBSECTIONS" => "Y",
										"MESSAGE_404" => "",
										"NEWS_COUNT" => "1",
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
											0 => "",
											1 => "AUTHOR",
											2 => "FIX",
											3 => "PHOTOGRAPH",
											4 => "",
											5 => "",
											6 => "",
											7 => "",
											8 => "",
										),
										"SET_BROWSER_TITLE" => "N",
										"SET_LAST_MODIFIED" => "N",
										"SET_META_DESCRIPTION" => "N",
										"SET_META_KEYWORDS" => "N",
										"SET_STATUS_404" => "N",
										"SET_TITLE" => "N",
										"SHOW_404" => "N",
										"SORT_BY1" => "ACTIVE_FROM",
										"SORT_BY2" => "SORT",
										"SORT_ORDER1" => "DESC",
										"SORT_ORDER2" => "ASC",
										"STRICT_SECTION_CHECK" => "N",
										"COMPONENT_TEMPLATE" => "mx_news_main"
									),
									false
								);?>

						</div>	
							
					<div class="news_main__pair">
						<?
							GLOBAL $arrFilter;
								$arrFilter = array( "!PROPERTY_FIX_VALUE" => "Y" ); 
						?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mx_news_main", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
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
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
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
			0 => "",
			1 => "AUTHOR",
			2 => "FIX",
			3 => "PHOTOGRAPH",
			4 => "",
			5 => "",
			6 => "",
			7 => "",
			8 => "",
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
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mx_news_main"
	),
	false
);?>	
					</div><!--//news_main__pair-->
				
					<div class="clear"></div>
				</div>

			</div>
		</div>

		<div class="clear"></div>

		<div class="row">
			<div class="news_main__social">
				<div class="news_main__social__title">Мы в соцсетях</div>
				<div class="news_main__social__links">
					<div class="news_main__social__links__item">
						<a href="https://www.facebook.com/bobrovylog" class="news_main__social__links__item__icon item__icon_fb"></a>
					</div>
					<div class="news_main__social__links__item">
						<a href="https://vk.com/bobrovylog" class="news_main__social__links__item__icon item__icon_vk"></a>
					</div>
					<div class="news_main__social__links__item">
						<a href="https://www.instagram.com/bobrolog/" class="news_main__social__links__item__icon item__icon_inst"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<div class="main_service">
	<div class="container-fluid">
		<div class="row">

			<?
				GLOBAL $arrFilter;

				if($_COOKIE["color_theme"] == "zima") {
					$arrFilter = array( "PROPERTY_ZIMA_VALUE" => "Y" );	?>			
					<div class="main_service__block main_service__block_zima">
				<?} else {?>
					<?$arrFilter = array( "!PROPERTY_ZIMA_VALUE" => "Y" );	?>			
					<div class="main_service__block main_service__block_leto">

				<?}?>
			<?

				$APPLICATION->IncludeComponent("bitrix:news.list", "mx_podborka", Array(
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
						"IBLOCK_ID" => "5",	// Код информационного блока
						"IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
						"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
						"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
						"NEWS_COUNT" => "1",	// Количество новостей на странице
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
							0 => "ZIMA",
							1 => "SERVICES",
							2 => "",
							3 => "",
							4 => "",
							5 => "",
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

			
		</div>
	</div>
</div>


<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>