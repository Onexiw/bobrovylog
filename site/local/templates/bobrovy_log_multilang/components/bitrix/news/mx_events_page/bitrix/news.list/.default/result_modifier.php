<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['ITEMS'] as $key => $arItem) {
	
	$day = substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2);
	$month = substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2);
	$year = substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 6, 4);
	
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
	
	$mw = array(
		'01' => 'ЯНВАРЬ',
		'02' => 'ФЕВРАЛЬ',
		'03' => 'МАРТ',
		'04' => 'АПРЕЛь',
		'05' => 'МАЙ',
		'06' => 'ИЮНЬ',
		'07' => 'ИЮЛЬ',
		'08' => 'АВГУСТ',
		'09' => 'СЕНТЯБРЬ',
		'10' => 'ОКТЯБРЬ',
		'11' => 'НОЯБРЬ',
		'12' => 'ДЕКАБРЬ',
	);
		
	$arResult["ITEMS"][$key]["DATE"] = $day;
	$arResult["ITEMS"][$key]["MONTH"] = $m[$month];
	$arResult["ITEMS"][$key]["MONTH_WORD"] = $mw[$month];
	$arResult["ITEMS"][$key]["YEAR"] = $year;
	
	$arResult["ORDER"][$year][$month][$key] = $arItem;
	$arResult["ORDER"][$year][$month][$key]["DATE"] = $day;
	$arResult["ORDER"][$year][$month][$key]["MONTH"] = $m[$month];
	$arResult["ORDER"][$year][$month][$key]["MONTH_WORD"] = $mw[$month];
	$arResult["ORDER"][$year][$month][$key]["YEAR"] = $year;
	
	
}
?>