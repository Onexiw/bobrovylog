<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
//d($arResult);
foreach ($arResult['ITEMS'] as $key => $arItem) {
	//d($arItem);
			$service = array();
	foreach($arItem["PROPERTIES"]["SERVICES"]["VALUE"] as $k => $arService) {
//d($arService);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL","DETAIL_PICTURE","PROPERTY_NAME_ENG");
			$arFilter = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arService);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				//d($arFields);
				//$arProps = $ob->GetProperties();
				//d($arProps);
				//d($arFields["NAME"]);

				$service[$arFields["ID"]]["NAME"] = $arFields["NAME"];
				$service[$arFields["ID"]]["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];
				$service[$arFields["ID"]]["NAME__ENG"] = $arFields["PROPERTY_NAME_ENG_VALUE"];
				$file = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>116, 'height'=>116), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$service[$arFields["ID"]]["PICTURE"] = $file["src"];
				
			}
			
			$arResult['ITEMS'][$key]["SERVICES"] = $service;
	}
	
	
}

//d($arResult['ITEMS'][$key]["SERVICES"]);
?>