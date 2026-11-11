<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
   $arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval($arParams["ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0)
   $arParams["DEPTH_LEVEL"]=1;

$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();

if($this->StartResultCache())
{
   if(!CModule::IncludeModule("iblock"))
   {
      $this->AbortResultCache();
   }
   else
   {
      $arFilter = array(
         "IBLOCK_ID"=>$arParams["IBLOCK_ID"],
         "GLOBAL_ACTIVE"=>"Y",
         "IBLOCK_ACTIVE"=>"Y",
         "<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
      );
      $arOrder = array(
         "left_margin"=>"asc",
      );

      $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
         "ID",
         "DEPTH_LEVEL",
         "NAME",
         "SECTION_PAGE_URL",
      ));
      if($arParams["IS_SEF"] !== "Y")
         $rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
      else
         $rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);
      while($arSection = $rsSections->GetNext())
      {
         $arResult["SECTIONS"][] = array(
            "ID" => $arSection["ID"],
            "DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
            "~NAME" => $arSection["~NAME"],
            "~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
         );
         $arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
      }
      $this->EndResultCache();
   }
}

//In "SEF" mode we'll try to parse URL and get ELEMENT_ID from it
if($arParams["IS_SEF"] === "Y")
{
   $componentPage = CComponentEngine::ParseComponentPath(
      $arParams["SEF_BASE_URL"],
      array(
         "section" => $arParams["SECTION_PAGE_URL"],
         "detail" => $arParams["DETAIL_PAGE_URL"],
      ),
      $arVariables
   );
   if($componentPage === "detail")
   {
      CComponentEngine::InitComponentVariables(
         $componentPage,
         array("SECTION_ID", "ELEMENT_ID"),
         array(
            "section" => array("SECTION_ID" => "SECTION_ID"),
            "detail" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID"),
         ),
         $arVariables
      );
      $arParams["ID"] = intval($arVariables["ELEMENT_ID"]);
   }
}

if(($arParams["ID"] > 0) && (intval($arVariables["SECTION_ID"]) <= 0) && CModule::IncludeModule("iblock"))
{
   $arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID");
   $arFilter = array(
      "ID" => $arParams["ID"],
      "ACTIVE" => "Y",
      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
   );
   $rsElements = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
   if(($arParams["IS_SEF"] === "Y") && (strlen($arParams["DETAIL_PAGE_URL"]) > 0))
      $rsElements->SetUrlTemplates($arParams["SEF_BASE_URL"].$arParams["DETAIL_PAGE_URL"]);
   while($arElement = $rsElements->GetNext())
   {
      $arResult["ELEMENT_LINKS"][$arElement["IBLOCK_SECTION_ID"]][] = $arElement["~DETAIL_PAGE_URL"].'/';
   }
}

$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection)
{
		
	$res = CIBlockSection::GetByID($arSection["ID"]);
	if($ar_res = $res->GetNext()) {
		//AddMessage2Log(var_export($ar_res,true));
		$mx_descr = $ar_res["DESCRIPTION"];
	}
	
   if ($menuIndex > 0)
      $aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
   $previousDepthLevel = $arSection["DEPTH_LEVEL"];

   $aMenuLinksNew[$menuIndex++] = array(
      htmlspecialchars($arSection["~NAME"]),
      $arSection["~SECTION_PAGE_URL"],
      $arResult["ELEMENT_LINKS"][$arSection["ID"]],
      array(
         "FROM_IBLOCK" => true,
         "IS_PARENT" => false,
         "DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
         "DESCR" => $mx_descr,
      ),
   );
   
   $sectionFilter = array(
      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
      "SECTION_ID" => $arSection["ID"],
      "GLOBAL_ACTIVE"=> "Y",
      "IBLOCK_ACTIVE"=> "Y",
      "ACTIVE" => "Y",
      "INCLUDE_SUBSECTIONS" => "Y"
   );
   
   CModule::IncludeModule("iblock");

   $arElements = CIBlockElement::GetList(Array("SORT"=>"ASC"), $sectionFilter);

   $depth = $arSection["DEPTH_LEVEL"] + 1;
   $parentIndex = $menuIndex;

   while($element = $arElements->GetNext()) {

			$res = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], "sort", "asc", array("CODE" => "NAME_ENG"));
			if ($ob = $res->GetNext()) {
				$VALUE = $ob['VALUE'];
		 		//AddMessage2Log(var_export($ob,true));
			}
				 		
      $aMenuLinksNew[$parentIndex-1][3]["IS_PARENT"] = true;
      
      $aMenuLinksNew[$menuIndex++] = array(
	      $element["NAME"],
	      $element["~DETAIL_PAGE_URL"].'/',
	      array("DESCR" => $VALUE),
	      array(
	         "FROM_IBLOCK" => true,
	         "IS_PARENT" => false,
	         "DEPTH_LEVEL" => $depth,
	      ),
      );
   }
   
}

return $aMenuLinksNew;
?>