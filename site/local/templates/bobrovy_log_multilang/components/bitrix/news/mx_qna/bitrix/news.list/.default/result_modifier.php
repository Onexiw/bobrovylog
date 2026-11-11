<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();


/*
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_CREATE","DETAIL_PAGE_URL","DETAIL_PICTURE", "DETAIL_TEXT", "PROPERTY_FIX", "PROPERTY_PHOTOGRAPH", "PROPERTY_AUTHOR");
$arFilter = Array("IBLOCK_ID"=>IntVal(4), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_FIX_VALUE" => "Y");
$res = CIBlockElement::GetList(Array("DATE_CREATE"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){ 
	$arFields = $ob->GetFields();  
	$arProps = $ob->GetProperties();
	//d($arProps);	
	$arResult['ITEMS']['FIX']["ID"] = $arFields["ID"];
	$arResult['ITEMS']['FIX']["DETAIL_PAGE_URL"] = $arFields["DETAIL_PAGE_URL"];
	$arResult['ITEMS']['FIX']["DETAIL_PICTURE"] = CFile::GetPath($arFields["DETAIL_PICTURE"]);
	//$arResult['ITEMS']['FIX']["DETAIL_TEXT"] = $arFields["~DETAIL_TEXT"];
	$arResult['ITEMS']['FIX']["NAME"] = $arFields["NAME"];
	$arResult['ITEMS']['FIX']["PHOTOGRAPH"] = $arProps["PHOTOGRAPH"]["VALUE"];
	$arResult['ITEMS']['FIX']["AUTHOR"] = $arProps["AUTHOR"]["VALUE"];
}
*/

?>