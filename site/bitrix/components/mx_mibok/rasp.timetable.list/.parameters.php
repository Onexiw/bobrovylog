<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));


$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arSorts = array("ASC"=>GetMessage("T_IBLOCK_DESC_ASC"), "DESC"=>GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = array(
		"ID"=>GetMessage("T_IBLOCK_DESC_FID"),
		"NAME"=>GetMessage("T_IBLOCK_DESC_FNAME"),
		"ACTIVE_FROM"=>GetMessage("T_IBLOCK_DESC_FACT"),
		"SORT"=>GetMessage("T_IBLOCK_DESC_FSORT"),
		"TIMESTAMP_X"=>GetMessage("T_IBLOCK_DESC_FTSAMP")
	);


$arProperty_LNS = array();
$arValueFilter = array();
$arListFieldProp = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
$arValueFilter[] = GetMessage("M_FILTER_MAIN_HEADER_NONE");
$arValueFilter['NAME'] = GetMessage("M_FILTER_FIELD")." [NAME] ".GetMessage("M_FILTER_FIELD_NAME");
$arListFieldProp['NAME'] = GetMessage("M_FILTER_FIELD")." [NAME] ".GetMessage("M_FILTER_FIELD_NAME");

while ($arr=$rsProp->Fetch())
{
    if(!empty($arr["CODE"]))
    {
        $arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")) && ($arr["USER_TYPE"] == '' || $arr["USER_TYPE"] == 'DateTime'))
        {
            $arProperty_LNS['PROPERTY_'.$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
            $arValueFilter['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
            $arListFieldProp['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
        }
    }
}

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "RASP_MIBOK", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arProperty_LNSF = array(
	"NAME" => GetMessage("MODAL_IBLOCK_ADD_NAME"),
	"DATE_ACTIVE_FROM" => GetMessage("MODAL_IBLOCK_ADD_ACTIVE_FROM"),
	"DATE_ACTIVE_TO" => GetMessage("MODAL_IBLOCK_ADD_ACTIVE_TO"),
	"PREVIEW_TEXT" => GetMessage("MODAL_IBLOCK_ADD_PREVIEW_TEXT"),
	"DETAIL_TEXT" => GetMessage("MODAL_IBLOCK_ADD_DETAIL_TEXT"),
);
$arVirtualProperties = $arProperty_LNSF;

$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID_RECORD"]));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["ID"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "F")))
	{
		$arProperty_LNSF[$arr["ID"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}


$arComponentParameters = array(
    "GROUPS" => array(
		"LIST_SETTINGS" => array(
            "SORT" => 120,
			"NAME" => GetMessage("M_LIST_SETTINGS"),
		),
		"LIST_SETTINGS_MODAL" => array(
            "SORT" => 130,
			"NAME" => GetMessage("M_LIST_SETTINGS_MODAL"),
		),
        "MODAL_RECORD" => array(
            "SORT" => 140,
			"NAME" => GetMessage("M_MODAL_RECORD"),
		),
        "SIGN" => array(
            "SORT" => 150,
			"NAME" => GetMessage("M_SIGN"),
		),
	),
	"PARAMETERS" => array(
		//"AJAX_MODE" => array(),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"DEFAULT" => "news",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
		),
		"FILTER_NAME" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("T_IBLOCK_FILTER"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
        "LIST_SETTINGS_NAME" => array(
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("M_LIST_SETTINGS_NAME"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arListFieldProp,
            "ADDITIONAL_VALUES" => "N",
        ),
        "LIST_SETTINGS_PROP1" => array(
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("M_LIST_SETTINGS_PROP1"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arValueFilter,
            "ADDITIONAL_VALUES" => "N",
        ),
        "LIST_SETTINGS_PROP2" => array(
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("M_LIST_SETTINGS_PROP2"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arValueFilter,
            "ADDITIONAL_VALUES" => "N",
        ),
        "LIST_SETTINGS_MODAL_NAME" => array(
            "PARENT" => "LIST_SETTINGS_MODAL",
            "NAME" => GetMessage("M_LIST_SETTINGS_MODAL_NAME"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arListFieldProp,
            "ADDITIONAL_VALUES" => "N",
        ),
        "LIST_SETTINGS_MODAL_FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("IBLOCK_FIELD"), "LIST_SETTINGS_MODAL"),
		"LIST_SETTINGS_MODAL_PROPERTY_CODE" => array(
			"PARENT" => "LIST_SETTINGS_MODAL",
			"NAME" => GetMessage("T_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
			"ADDITIONAL_VALUES" => "Y",
		),
        "IBLOCK_TYPE_RECORD" => array(
			"PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID_RECORD" => array(
			"PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks,
			"REFRESH" => "Y",
            "DEFAULT" => '={$_REQUEST["ID"]}',
			"ADDITIONAL_VALUES" => "Y",
		),
		"PROPERTY_CODES_RECORD" => array(
			"PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("MODAL_IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNSF,
		),

		"PROPERTY_CODES_RECORD_REQUIRED" => array(
			"PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("MODAL_IBLOCK_PROPERTY_REQUIRED"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arProperty_LNSF,
		),
        "EVENT_MESSAGE_ID" => Array(
            "PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("MFP_EMAIL_TEMPLATES"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"N", 
		),
        "SIGN_HEAD" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_HEAD"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_HEAD_VAL"),
            "COLS" => 25
		),
        "SIGN_RECORD" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_RECORD"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_RECORD_VAL"),
            "COLS" => 25
		),
        /*"SIGN_RECORD_OK" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_RECORD_OK"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_RECORD_OK_VAL"),
            "COLS" => 25
		),
        "SIGN_RECORD_BACK" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_RECORD_BACK"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_RECORD_BACK_VAL"),
            "COLS" => 25
		),*/
        "SIGN_FILTER" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_FILTER"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_FILTER_VAL"),
            "COLS" => 25
		),
        "SIGN_NO_DAY" => Array(
            "PARENT" => "SIGN",
			"NAME" => GetMessage("M_SIGN_NO_DAY"), 
			"TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => GetMessage("M_SIGN_NO_DAY_VAL"),
            "COLS" => 25
		),
		"PARENT_SECTION" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("IBLOCK_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"PARENT_SECTION_CODE" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("IBLOCK_SECTION_CODE"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"INCLUDE_SUBSECTIONS" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BNL_INCLUDE_SUBSECTIONS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"CACHE_TIME"  =>  array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
