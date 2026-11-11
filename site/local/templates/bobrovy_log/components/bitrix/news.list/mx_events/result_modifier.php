<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['ITEMS'] as $key => $arItem) {
	
	$day = substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2);
	$month = substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2);
	
	$m = array(
		'01' => 'ЯНВАРЯ',
		'02' => 'ФЕВРАЛЯ',
		'03' => 'МАРТА',
		'04' => 'АПРЕЛЯ',
		'05' => 'МАЯ',
		'06' => 'ИЮНЯ',
		'07' => 'ИЮЛЯ',
		'08' => 'АВГУСТА',
		'09' => 'СЕНТЯБРЯ',
		'10' => 'ОКТЯБРЯ',
		'11' => 'НОЯБРЯ',
		'12' => 'ДЕКАБРЯ',
	);
	
	$arResult["ITEMS"][$key]["DATE"] = $day;
	$arResult["ITEMS"][$key]["MONTH"] = $m[$month];
}
?>