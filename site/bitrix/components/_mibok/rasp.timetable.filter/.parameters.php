<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */
use Bitrix\Main\Loader;
use Bitrix\Iblock;

if (!Loader::includeModule("iblock"))
	return;
//$catalogIncluded = Loader::includeModule('catalog');
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$arProperty = array();
$arProperty_N = array();
if ($iblockExists)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE'),
		'filter' => array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];
		if ($propertyCode == '')
			$propertyCode = $property['ID'];
		$propertyName = '['.$propertyCode.'] '.$property['NAME'];

		if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
			$arProperty[$propertyCode] = $propertyName;

		if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER)
			$arProperty_N[$propertyCode] = $propertyName;
	}
	unset($propertyCode, $propertyName, $property, $propertyIterator);
}


//$arProperty_LNS = array();
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
        //$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E")) && ($arr["USER_TYPE"] == '' || $arr["USER_TYPE"] == 'DateTime'))
        {
            //$arProperty_LNS['PROPERTY_'.$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
            $arValueFilter['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
            $arListFieldProp['PROPERTY_'.$arr["CODE"]] =  GetMessage("M_FILTER_PROP")." [".$arr["CODE"]."] ".$arr["NAME"];
        }
    }
}

$arComponentParameters = array(
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"FILTER_NAME" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_FILTER_NAME_OUT"),
			"TYPE" => "STRING",
			"DEFAULT" => "arrMibokTt",
		),
		"FILTER_DATE_RANGE" => array(
			"PARENT" => "FILTER_SETTINGS",
			"NAME" => GetMessage("M_FILTER_DATE_RANGE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "FILTER_MAIN_HEADER" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("M_FILTER_MAIN_HEADER"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arValueFilter,
            "ADDITIONAL_VALUES" => "N",
        ),
        "FILTER_ALL_VALUE" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("M_FILTER_ALL_VALUE"),
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => $arValueFilter,
            "ADDITIONAL_VALUES" => "N",
            "SIZE" => 6
        ),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BCF_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		
		"SAVE_IN_SESSION" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("IBLOCK_SAVE_IN_SESSION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
            "HIDDEN" => "Y"
		),
		"PAGER_PARAMS_NAME" => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BCF_PAGER_PARAMS_NAME"),
			"TYPE" => "STRING",
			"DEFAULT" => "arrPager"
		),
	),
);
