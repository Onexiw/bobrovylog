<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
global $DB;
/** @global CUser $USER */
global $USER;
/** @global CMain $APPLICATION */
global $APPLICATION;
use Bitrix\Main\Loader;
/*************************************************************************
	Work with module
*************************************************************************/
$module_id = "mibok.rasp";
if(!IsModuleInstalled($module_id))
    return;
$loadRes = Loader::includeSharewareModule($module_id);
if($loadRes == 0 || $loadRes == 3)
    return;
$arOption = array("period_begin", "period_end");

CJSCore::Init(array("jquery"));
/*************************************************************************
	Processing of received parameters
*************************************************************************/

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

unset($arParams["IBLOCK_TYPE"]); //was used only for IBLOCK_ID setup with Editor
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

if(!is_array($arParams["FILTER_MAIN_HEADER"]))
	$arParams["FILTER_MAIN_HEADER"] = array($arParams["FILTER_MAIN_HEADER"]);
if(!is_array($arParams["FILTER_ALL_VALUE"]))
	$arParams["FILTER_ALL_VALUE"] = array($arParams["FILTER_ALL_VALUE"]);

$arParamFilter = array();
$arParamField = array();
$arParamProp = array();

$arParamFilter = array_unique(array_merge($arParams["FILTER_MAIN_HEADER"], $arParams["FILTER_ALL_VALUE"]));
foreach ($arParamFilter as $param)
{
    if(strpos($param, 'PROPERTY_') === false)
        $arParamField[] = $param;
    else
        $arParamProp[] = str_replace ('PROPERTY_', '', $param);
}

$arParams["SAVE_IN_SESSION"] = $arParams["SAVE_IN_SESSION"]=="Y";

if(strlen($arParams["FILTER_NAME"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
	$arParams["FILTER_NAME"] = "arrMibokTt";
$FILTER_NAME = $arParams["FILTER_NAME"];

global ${$FILTER_NAME};
${$FILTER_NAME} = array();



/*************************************************************************
	Work with Request data
*************************************************************************/
//p($_POST);
if(isset($_POST['del_filter']))
{
    $arResult['REQUEST'] = array();
}
elseif(isset($_POST['set_filter']))
{
    foreach($_POST as $keyP => $arValue)
    {
        if($keyP == 'PROPERTY')
        {
            foreach($arValue as $keyProp => $arProp)
            {
                if(in_array($keyProp, $arParamProp))
                {
                    $arResult['REQUEST']['PROPERTY'][$keyProp] = $arProp;
                }
            }
        }
		elseif($keyP == 'period_begin' || $keyP == 'period_end')
		{
			 $arResult['REQUEST'][$keyP] = $arValue;
		}
        else
        {
            if(in_array($keyP, $arParamField))
            {
                $arResult['REQUEST'][$keyP] = $arValue;
            }
        }
    }
}


/*************************************************************************
	Get data
*************************************************************************/
//p($arResult['REQUEST']);
if($this->startResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arResult['REQUEST'])))
//if ($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()).json_encode($arResult['REQUEST'])))
{
    $arTypeProp = array();

    //field - NAME
    $arTemp = array(
        "CODE" => 'NAME',
        "NAME" => GetMessage('FIELD_NAME'),
        "PROPERTY_TYPE" => 'field',
        "USER_TYPE" => '',
    );
    $arTypeProp['NAME'] = $arTemp;
    $arFilterProp = Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
    $arSelectProp = array();
    $arGroupProp = array('NAME');
    $res = CIBlockElement::GetList(Array('NAME' => 'asc'), $arFilterProp, $arGroupProp, false, $arSelectProp);
    
    while($arElement = $res->Fetch())
    {
        $arTemp["VALUE_LIST"][] = $arElement['NAME'];
    }
    if(in_array('NAME', $arParams['FILTER_MAIN_HEADER']))
        $arResult["FILTER_HEADER"]['field'] = $arTemp;
    elseif(in_array('NAME', $arParams['FILTER_ALL_VALUE']))
        $arResult["FILTER_ALL"]['field'] = $arTemp;
    
	// properties
	$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
	while ($arProp = $rsProp->Fetch())
	{ 
		if(in_array($arProp["CODE"],$arParamProp) && in_array($arProp["PROPERTY_TYPE"], array("L", "N", "S", "E")) && ($arProp["USER_TYPE"] == '' || $arProp["USER_TYPE"] == 'DateTime'))
		{
			$arTemp = array(
				"CODE" => $arProp["CODE"],
				"NAME" => $arProp["NAME"],
                "PROPERTY_TYPE" => $arProp["PROPERTY_TYPE"],
                "USER_TYPE" => $arProp["USER_TYPE"],
			);
            $arTypeProp['PROPERTY'][$arTemp['CODE']] = $arTemp;
			if ($arProp["PROPERTY_TYPE"] == "L")
			{
				$arrEnum = array();
				$rsEnum = CIBlockProperty::GetPropertyEnum($arProp["ID"], array('sort' => 'asc', 'id' => 'asc'));
				while($arEnum = $rsEnum->Fetch())
				{
					$arrEnum[$arEnum["ID"]] = $arEnum["VALUE"];
				}
				$arTemp["VALUE_LIST"] = $arrEnum;
			}
            elseif($arProp["PROPERTY_TYPE"] == "E")
            {
                $arFilterProp = Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
                $arSelectProp = array();
                if($arProp['CODE'] != 'TEACHER')
                    $arGroupProp = array('PROPERTY_'.$arProp['CODE'], 'PROPERTY_'.$arProp['CODE'].'.NAME');
                else
                    $arGroupProp = array('PROPERTY_'.$arProp['CODE'], 'PROPERTY_'.$arProp['CODE'].'.NAME', 'PROPERTY_'.$arProp['CODE'].'.PROPERTY_LASTNAME', 'PROPERTY_'.$arProp['CODE'].'.PROPERTY_SURNAME');
                $res = CIBlockElement::GetList(Array('PROPERTY_'.$arProp['CODE'] => 'asc'), $arFilterProp, $arGroupProp, false, $arSelectProp);
                while($arElement = $res->Fetch())
                {
                    if(!empty($arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE']))
                    {
                        if($arProp['CODE'] != 'TEACHER')
                            $arTemp["VALUE_LIST"][$arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE']] = $arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_NAME'];
                        else
                        {
                            $arTemp["VALUE_LIST"][$arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE']] = 
                                $arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_PROPERTY_SURNAME_VALUE'] .' '
                                . mb_substr($arElement['PROPERTY_'.$arProp['CODE'].'_NAME'],0,1) . '.';
                            if(!empty($arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_PROPERTY_LASTNAME_VALUE']))
                                $arTemp["VALUE_LIST"][$arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE']] .= ' ' . mb_substr($arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_PROPERTY_LASTNAME_VALUE'],0,1) . '.';
                        }   
                    }
                }
            }
            elseif($arProp["PROPERTY_TYPE"] == "S")
            {
                $arFilterProp = Array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y');
                $arSelectProp = array();
                $arGroupProp = array('PROPERTY_'.$arProp['CODE']);
                $res = CIBlockElement::GetList(Array('PROPERTY_'.$arProp['CODE'] => 'asc'), $arFilterProp, $arGroupProp, false, $arSelectProp);  
                while($arElement = $res->Fetch())
                {
                    if(!empty($arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE']))
                        $arTemp["VALUE_LIST"][] = $arElement['PROPERTY_'.strtoupper($arProp['CODE']).'_VALUE'];
                }
            }  
            if(in_array('PROPERTY_'.$arProp["CODE"], $arParams['FILTER_MAIN_HEADER']))
                $arResult["FILTER_HEADER"][$arProp["ID"]] = $arTemp;
            elseif(in_array('PROPERTY_'.$arProp["CODE"], $arParams['FILTER_ALL_VALUE']))
                $arResult["FILTER_ALL"][$arProp["ID"]] = $arTemp;
		}
	}
    $arResult['TYPE_PROPERTY'] = $arTypeProp;
    
    //period
    $arDay = array();
    $arDayView = array();
    foreach($arOption as $option)
        $arResult['OPTIONS'][$option] =  COption::GetOptionString($module_id, $option);
    if(!empty($arResult['OPTIONS']['period_end']))
    {
        $periodSTMP = time();
        $periodSec = 86400;
        for($i = $arResult['OPTIONS']['period_begin']; $i <= (intval($arResult['OPTIONS']['period_end'])); $i++)
        {
            $val = $periodSTMP + ($i * $periodSec);
            $arDay[] = $val;
            $arDayView[] = date('d.m.Y', $val);
//            $arDayName[$val] = date('D', $val);
//            $arDayWeek[$val] = date('W', $val);
        }
    }
    $arResult['DAY'] = $arDay;
    $arResult['PERIOD'] = $arDayView;
    if(!empty($arResult['OPTIONS']['period_begin']))
        $arResult['DATEPICKER']['MIN_DATE'] = date('d.m.Y', strtotime($arResult['OPTIONS']['period_begin']." day"));
    else
        $arResult['DATEPICKER']['MIN_DATE'] = date('d.m.Y');
    if(!empty($arResult['OPTIONS']['period_end']))
        $arResult['DATEPICKER']['DATE_LIMIT'] = $arResult['OPTIONS']['period_end'];
    else
        $arResult['DATEPICKER']['DATE_LIMIT'] = 30;
    
    
    //p($arResult);
	$this->EndResultCache();
}

//help to create html

mibokCreateList($arResult['FILTER_HEADER'], $arResult['REQUEST']);
mibokCreateList($arResult['FILTER_ALL'], $arResult['REQUEST']);

$arResult["FORM_ACTION"] = isset($_SERVER['REQUEST_URI'])? htmlspecialcharsbx($_SERVER['REQUEST_URI']): "";
$arResult["FILTER_NAME"] = $FILTER_NAME;


//create value for output Filter


$myFilter = array();
if(isset($arResult['REQUEST']) && !empty($arResult['REQUEST']))
{
    foreach($arResult['REQUEST'] as $keyP => $arValue)
    {
        if($keyP == 'PROPERTY')
        {
            foreach($arValue as $keyProp => $arProp)
            {
                if($arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['PROPERTY_TYPE'] == 'S' && empty($arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['USER_TYPE']))
                    mibokStringFilter($myFilter,$keyProp, $arProp, true);
                elseif($arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['PROPERTY_TYPE'] == 'S' && $arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['USER_TYPE'] == 'DateTime')
                    mibokDateFilter($myFilter,$keyProp, $arProp, true);
                elseif($arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['PROPERTY_TYPE'] == 'E' || $arResult['TYPE_PROPERTY']['PROPERTY'][$keyProp]['PROPERTY_TYPE'] == 'L')
                    mibokListFilter($myFilter,$keyProp, $arProp, true);
            }
        }
		elseif($keyP == 'period_begin' || $keyP == 'period_end')
		{
			$myFilter[$keyP] = $arValue;
		}
        else
        {
            mibokStringFilter($myFilter,$keyP, $arValue);
        }
    }
}

${$FILTER_NAME} = $myFilter;







function mibokStringFilter(&$myFilter,$keyP, $arValue, $bProp = false)
{
    if($bProp)
    {
        $keyP = 'PROPERTY_'.$keyP;
    }
    if(!empty($arValue))
    {
        if(count($arValue) > 1)
        {
            $myFilter['?'.$keyP] = '(';
            foreach($arValue as $keyF => $valFil)
            {
                $myFilter['?'.$keyP] .= $valFil;
                if(isset($arValue[$keyF + 1]))
                    $myFilter['?'.$keyP] .= ' || ';
            }
            $myFilter['?'.$keyP] .= ')';
        }
        else
        {
            $myFilter[$keyP] = $arValue[0];
        }
    }
}

function mibokDateFilter(&$myFilter,$keyP, $arValue, $bProp = false)
{
    global $DB;
    if($bProp)
    {
        $keyP = 'PROPERTY_'.$keyP;
    }
    if(!empty($arValue))
    {
        if(count($arValue) > 1)
        {
            $myFilter['?'.$keyP] = '(';
            foreach($arValue as $keyF => $valFil)
            {
                $myFilter['?'.$keyP] .= $DB->CharToDateFunction($valFil);
                if(isset($arValue[$keyF + 1]))
                    $myFilter['?'.$keyP] .= ' || ';
            }
            $myFilter['?'.$keyP] .= ')';
        }
        else
        {
            $myFilter['?'.$keyP] = $DB->CharToDateFunction($arValue[0]);
        }
    }
}

function mibokListFilter(&$myFilter,$keyP, $arValue, $bProp = false)
{
    global $DB;
    if($bProp)
    {
        $keyP = 'PROPERTY_'.$keyP;
    }
    if(!empty($arValue))
    {
        if(count($arValue) > 1)
        {
            $myFilter[$keyP] = array();
            foreach($arValue as $keyF => $valFil)
            {
                $myFilter[$keyP][] = $valFil;
            }
        }
        else
        {
            $myFilter[$keyP] = $arValue[0];
        }
    }
}



function mibokCreateList(&$arData, $arRequest)
{
    if(!empty($arData))
    {
        foreach($arData as $key => &$arValue)
        {
            $nameBlock = '';
            if(!empty($arValue['VALUE_LIST']))
            {
                $nameCheck = ($arValue['PROPERTY_TYPE'] == 'field' ? $arValue['CODE'].'[]' : 'PROPERTY['.$arValue['CODE'].'][]');
                foreach($arValue['VALUE_LIST'] as $keyV => $value)
                {
                    $valueCheck = false;
                    $checked = '';
                    if($arValue['PROPERTY_TYPE'] == 'field' || $arValue['PROPERTY_TYPE'] == 'S')
                    {
                        $valueCheck  = $value;
                        if(isset($arRequest[$arValue['CODE']]) && $arValue['PROPERTY_TYPE'] == 'field' && in_array($valueCheck, $arRequest[$arValue['CODE']]))
                        {
                            $checked = 'checked';

                        }
                        elseif(isset($arRequest['PROPERTY'][$arValue['CODE']]) && $arValue['PROPERTY_TYPE'] == 'S' && in_array($valueCheck, $arRequest['PROPERTY'][$arValue['CODE']]))
                        {
                            $checked = 'checked';
                        }
                    }
                    else
                    {
                        $valueCheck = $keyV;
                        if(isset($arRequest['PROPERTY'][$arValue['CODE']]) && in_array($valueCheck, $arRequest['PROPERTY'][$arValue['CODE']]))
                        {
                            $checked = 'checked';
                        }
                    }

                    if($checked == 'checked')
                    {
                        if($nameBlock != '')
                            $nameBlock .= ', ';
                        $nameBlock .= $value;
                    }
                    $arValue['VALUE_CHECK'][$keyV] = $valueCheck;
                    $arValue['CHECKED'][$keyV] = $checked;
                }
                $arValue['NAME_CHECK'] = $nameCheck;
                if(empty($nameBlock))
                    $nameBlock = GetMessage('DEFAULT_ALL');
                $arValue['NAME_BLOCK'] = $nameBlock;
            }
        }
    }
}



$this->IncludeComponentTemplate();
?>