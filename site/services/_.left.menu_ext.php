<?
    global $APPLICATION;
    $aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => SITE_DIR,
		"SECTION_PAGE_URL" => "",
		"DETAIL_PAGE_URL" => "/#IBLOCK_TYPE_ID#/#ELEMENT_CODE#",
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => "2",
		"DEPTH_LEVEL" => "2",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false,
	array(
		"HIDE_ICONS" => "N"
	)
);

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>