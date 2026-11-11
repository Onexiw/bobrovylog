<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['ITEMS'] as $key => $arItem) {
	
	foreach($arItem["PROPERTIES"]["SERVICES"]["VALUE"] as $k => $arService) {

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT","PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>IntVal(7), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arService);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields();  
			//d($arFields);
		$arProps = $ob->GetProperties();
			//d($arProps);
			
			$arResult["ITEMS"][$key]["SERVICE"][$k]["ID"] = $arFields["ID"];			
			$arResult["ITEMS"][$key]["SERVICE"][$k]["NAME"] = $arFields["NAME"];			
			$arResult["ITEMS"][$key]["SERVICE"][$k]["DETAIL_TEXT"] = $arFields["DETAIL_TEXT"];			
			$arResult["ITEMS"][$key]["SERVICE"][$k]["ICON"] = CFile::GetPath($arProps["ICON"]["VALUE"]);			
		}

	}
	
	//$arResult["ITEMS"][$key]["SERVICE"]["ID"] = 
	//$arResult["ITEMS"][$key]["DATE"] = $day;
	//$arResult["ITEMS"][$key]["MONTH"] = $m[$month];

}
?>