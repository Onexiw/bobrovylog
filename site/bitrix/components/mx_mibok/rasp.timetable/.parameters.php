<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

/*
$arSorts = Array("ASC"=>GetMessage("T_IBLOCK_DESC_ASC"), "DESC"=>GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = Array(
		"ID"=>GetMessage("T_IBLOCK_DESC_FID"),
		"NAME"=>GetMessage("T_IBLOCK_DESC_FNAME"),
		"ACTIVE_FROM"=>GetMessage("T_IBLOCK_DESC_FACT"),
		"SORT"=>GetMessage("T_IBLOCK_DESC_FSORT"),
		"TIMESTAMP_X"=>GetMessage("T_IBLOCK_DESC_FTSAMP")
	);
*/
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
        if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")) && ($arr["USER_TYPE"] == '' || $arr["USER_TYPE"] == 'DateTime') && $arr["CODE"] != 'SEND_EMAIL')
        {
            $arProperty_LNS['PROPERTY_'.$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
            $arValueFilter['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
            $arListFieldProp['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
        }
    }
}

$arUGroupsEx = Array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while($arUGroups = $dbUGroups -> Fetch())
{
	$arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
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
	//"DATE_ACTIVE_FROM" => GetMessage("MODAL_IBLOCK_ADD_ACTIVE_FROM"),
	//"DATE_ACTIVE_TO" => GetMessage("MODAL_IBLOCK_ADD_ACTIVE_TO"),
//	"PREVIEW_TEXT" => GetMessage("MODAL_IBLOCK_ADD_PREVIEW_TEXT"),
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
		"LIB_JS_CSS" => array(
			"SORT" => 100,
			"NAME" => GetMessage("M_LIB_JS_CSS"),
		),
		"FILTER_SETTINGS" => array(
			"SORT" => 110,
			"NAME" => GetMessage("T_IBLOCK_DESC_FILTER_SETTINGS"),
		),
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
        "USER_CONSENT" => array(),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
        "CHANGE_BOOTSTRAP" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_CHANGE_BOOTSTRAP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
        "IS_BOOTSTRAP_JS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_BOOTSTRAP_JS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_BOOTSTRAP_CSS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_BOOTSTRAP_CSS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_OWL_JS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_OWL_JS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_OWL_CSS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_OWL_CSS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_PS_JS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_PS_JS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_PS_CSS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_PS_CSS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_BOOTSTRAP_DP_JS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_BOOTSTRAP_DP_JS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "IS_BOOTSTRAP_DP_CSS" => array(
			"PARENT" => "LIB_JS_CSS",
			"NAME" => GetMessage("BN_P_IS_BOOTSTRAP_DP_CSS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"USE_FILTER" => Array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
            "REFRESH" => "Y",
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
			"NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID_RECORD" => array(
			"PARENT" => "MODAL_RECORD",
			"NAME" => GetMessage("BN_P_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
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
            "COLS" => 25,
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
		"USE_PERMISSIONS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_USE_PERMISSIONS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		"GROUP_PERMISSIONS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_GROUP_PERMISSIONS"),
			"TYPE" => "LIST",
			"VALUES" => $arUGroupsEx,
			"DEFAULT" => Array(1),
			"MULTIPLE" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("BN_P_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BN_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
/*
CIBlockParameters::AddPagerSettings(
	$arComponentParameters,
	GetMessage("T_IBLOCK_DESC_PAGER_NEWS"), //$pager_title
	true, //$bDescNumbering
	true, //$bShowAllParam
	true, //$bBaseLink
	$arCurrentValues["PAGER_BASE_LINK_ENABLE"]==="Y" //$bBaseLinkEnabled
);

 */

//CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);

if($arCurrentValues["USE_FILTER"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["FILTER_NAME"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("T_IBLOCK_FILTER"),
		"TYPE" => "STRING",
		"DEFAULT" => "arrMibokTt",
	);
    $arComponentParameters["PARAMETERS"]["FILTER_DATE_RANGE"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("M_FILTER_DATE_RANGE"),
		"TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["FILTER_MAIN_HEADER"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("M_FILTER_MAIN_HEADER"),
		"TYPE" => "LIST",
		"MULTIPLE" => "N",
		"VALUES" => $arValueFilter,
		"ADDITIONAL_VALUES" => "N",
	);
	$arComponentParameters["PARAMETERS"]["FILTER_ALL_VALUE"] = array(
		"PARENT" => "FILTER_SETTINGS",
		"NAME" => GetMessage("M_FILTER_ALL_VALUE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arValueFilter,
		"ADDITIONAL_VALUES" => "N",
        "SIZE" => 6
	);
	
}

if($arCurrentValues["USE_PERMISSIONS"]!="Y")
	unset($arComponentParameters["PARAMETERS"]["GROUP_PERMISSIONS"]);

?>
