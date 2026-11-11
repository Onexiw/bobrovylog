<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$tags = array();
foreach ($arResult['ITEMS'] as $key => $arItem) {
	//d($arItem);
	if($arItem["PROPERTIES"]["TAGS"]["VALUE"] != "") {
		if(!in_array($arItem["PROPERTIES"]["TAGS"]["VALUE"], $tags)) {
			$tags[] = $arItem["PROPERTIES"]["TAGS"]["VALUE"];
		}
	}
}
//d($tags);
$arResult["NEWS_TAGS"] = $tags;
//d($arResult["NEWS_TAGS"]);
?>