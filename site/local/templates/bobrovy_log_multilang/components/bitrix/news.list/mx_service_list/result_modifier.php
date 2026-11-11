<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

//сначала создадим массив секций, отсортированный по полю SORT
$sections = array();
$arFilter = Array('IBLOCK_ID'=>$arResult["ID"]);
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($ar_result = $db_list->GetNext())
{
	//echo $ar_result["NAME"];
	if(!in_array($ar_result["NAME"], $sections)){
		$sections[$ar_result["NAME"]] = array();
	  $sect_en[$ar_result['NAME']][] = $ar_result["DESCRIPTION"];
		//$sect_en[$ar_result["DESCRIPTION"]] = array();
	}
}
//d($sect_en);


foreach ($arResult['ITEMS'] as $key => $arItem) {
		
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	if($ar_res = $res->GetNext()) {
	  //echo $ar_res['NAME'];
	  $sections[$ar_res['NAME']][] = $arItem;
//		$sect_en[$ar_result["DESCRIPTION"]] = $arItem[""];
	}
	//}
	//d($arResult["SECTIONS"]);
}

//d($sections);

$arResult["SECTIONS"] = $sections;
$arResult["SECTIONS_EN"] = $sect_en;

//d($arResult["SECTIONS"]);

?>