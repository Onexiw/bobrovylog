<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $k => $arPhoto) {
	
	$path = CFile::GetPath($arPhoto);
	$arResult["PHOTOS"][$k] = $path;
}
//d($arResult);

$cp = $this->__component; 

if (is_object($cp))
{
   $cp->arResult['MON']['FROM'] =  $arResult["PROPERTIES"]["MON"]["VALUE"];
   $cp->arResult['MON']['TO'] =  $arResult["PROPERTIES"]["MON"]["DESCRIPTION"];
   $cp->arResult['TUE']['FROM'] =  $arResult["PROPERTIES"]["TUE"]["VALUE"];
   $cp->arResult['TUE']['TO'] =  $arResult["PROPERTIES"]["TUE"]["DESCRIPTION"];
   $cp->arResult['WED']['FROM'] =  $arResult["PROPERTIES"]["WED"]["VALUE"];
   $cp->arResult['WED']['TO'] =  $arResult["PROPERTIES"]["WED"]["DESCRIPTION"];
   $cp->arResult['THU']['FROM'] =  $arResult["PROPERTIES"]["THU"]["VALUE"];
   $cp->arResult['THU']['TO'] =  $arResult["PROPERTIES"]["THU"]["DESCRIPTION"];
   $cp->arResult['FRI']['FROM'] =  $arResult["PROPERTIES"]["FRI"]["VALUE"];
   $cp->arResult['FRI']['TO'] =  $arResult["PROPERTIES"]["FRI"]["DESCRIPTION"];
   $cp->arResult['SAT']['FROM'] =  $arResult["PROPERTIES"]["SAT"]["VALUE"];
   $cp->arResult['SAT']['TO'] =  $arResult["PROPERTIES"]["SAT"]["DESCRIPTION"];
   $cp->arResult['SUN']['FROM'] =  $arResult["PROPERTIES"]["SUN"]["VALUE"];
   $cp->arResult['SUN']['TO'] =  $arResult["PROPERTIES"]["SUN"]["DESCRIPTION"];
   $cp->SetResultCacheKeys(array('MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'));

   $arResult['MON'] = $cp->arResult['MON'];
   $arResult['TUE'] = $cp->arResult['TUE'];
   $arResult['WED'] = $cp->arResult['WED'];
   $arResult['THU'] = $cp->arResult['THU'];
   $arResult['FRI'] = $cp->arResult['FRI'];
   $arResult['SAT'] = $cp->arResult['SAT'];
   $arResult['SUN'] = $cp->arResult['SUN'];
}
?>