<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


foreach ($arResult['ITEMS'] as $key => $arItem) {
	
		
		$set = array();
		foreach($arItem["PROPERTIES"]["SERVICES"]["VALUE"] as $k => $arService) {
			
			
			$arSelectSet = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_*");
			$arFilterSet = Array("IBLOCK_ID"=>IntVal(2), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arService);
			$resSet = CIBlockElement::GetList(Array(), $arFilterSet, false, false, $arSelectSet);
			while($obSet = $resSet->GetNextElement()){ 
			$arFieldsSet = $obSet->GetFields();  
				//d($arFieldsSet);
			$arPropsSet = $obSet->GetProperties();
				//d($arPropsSet);
			
				$set[$arFieldsSet["ID"]]["NAME"] = $arFieldsSet["NAME"];
				$set[$arFieldsSet["ID"]]["NAME_ENG"] = $arPropsSet["NAME_ENG"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["PREVIEW_TEXT"] = $arFieldsSet["PREVIEW_TEXT"];
			  $set[$arFieldsSet["ID"]]["TEXT_ENG"] = $arPropsSet["TEXT_ENG"]["~VALUE"]["TEXT"];
			  $set[$arFieldsSet["ID"]]["DETAIL_PICTURE"] = CFile::GetPath($arFieldsSet["DETAIL_PICTURE"]);
			  $set[$arFieldsSet["ID"]]["DETAIL_PAGE_URL"] = $arFieldsSet["DETAIL_PAGE_URL"];
			  $set[$arFieldsSet["ID"]]["Mon"]["FROM"] = $arPropsSet["MON"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Mon"]["TO"] = $arPropsSet["MON"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Tue"]["FROM"] = $arPropsSet["TUE"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Tue"]["TO"] = $arPropsSet["TUE"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Wed"]["FROM"] = $arPropsSet["WED"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Wed"]["TO"] = $arPropsSet["WED"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Thu"]["FROM"] = $arPropsSet["THU"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Thu"]["TO"] = $arPropsSet["THU"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Fri"]["FROM"] = $arPropsSet["FRI"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Fri"]["TO"] = $arPropsSet["FRI"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Sat"]["FROM"] = $arPropsSet["SAT"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Sat"]["TO"] = $arPropsSet["SAT"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["Sun"]["FROM"] = $arPropsSet["SUN"]["VALUE"];
			  $set[$arFieldsSet["ID"]]["Sun"]["TO"] = $arPropsSet["SUN"]["DESCRIPTION"];
			  $set[$arFieldsSet["ID"]]["WORK_TIME"] = $arPropsSet["WORK_TIME"]["~VALUE"]["TEXT"];
			  $set[$arFieldsSet["ID"]]["WORK_TIME_ENG"] = $arPropsSet["WORK_TIME_ENG"]["~VALUE"]["TEXT"];
			  
			  $set[$arFieldsSet["ID"]]["ADDITIONAL"] = $arPropsSet["ADDITIONAL"]["~VALUE"]["TEXT"];
			  $set[$arFieldsSet["ID"]]["ADDITIONAL_ENG"] = $arPropsSet["ADDITIONAL_ENG"]["~VALUE"]["TEXT"];
			}
	
		}
			
		$arResult["ITEMS"][$key]["SET"] = $set;

}
?>