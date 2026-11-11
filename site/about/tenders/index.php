<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Закупки");
?>

<div class="news_page">
	<div class="container-fluid">

		<div class="row">
			<div class="col-xs-12 news_page__head">
				
				<div class="news_page__head__title">Закупки</div>
						
				<div class="news_page__head__social__title">Мы в соцсетях</div>
				<div class="news_page__head__social__links">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/social.php"
						)
					);?>
				</div>
				
				<div class="clear"></div>
				<a href="/tenders-ended/" class="tender_link">Завершенные тендеры</a>

		
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<p>Закупочная процедура (Тендер) является внутренней процедурой выбора контрагентов Обществом и не должен рассматриваться в качестве торгов в смысле статей 447–449 Гражданского кодекса Российской Федерации, а также не является публичным конкурсом, который регулируется главой 57 Гражданского кодекса Российской Федерации.</p>
				<p>Публикация Приглашения к участию в Закупочной процедуре (Тендере) не влечет для ООО «Ренонс» каких-либо юридических последствий, в том числе и обязанность заключать с кем-либо в будущем гражданско-правовые договоры.</p>
				<hr>
			</div>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mx_tenders", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
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
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9999",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => 20,
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "CONTACT",
			2 => "FULL_NAME",
			3 => "LAST_TEXT",
			4 => "FIRST_TEXT",
			5 => "FILES",
			6 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mx_tenders"
	),
	false
);?>
		</div>
	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>