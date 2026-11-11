<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_PHOTOS");
$arFilter = Array("IBLOCK_ID"=>IntVal(4), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){ 
	$arFields = $ob->GetFields();  
	$arProps = $ob->GetProperties();
	//d($arProps);	
	
	foreach($arProps["PHOTOS"]["VALUE"] as $k => $arPhoto){
		$arFile = CFile::GetFileArray($arPhoto);
		//d($arFile);
	}
	
	//exit();
	
	
}

?>