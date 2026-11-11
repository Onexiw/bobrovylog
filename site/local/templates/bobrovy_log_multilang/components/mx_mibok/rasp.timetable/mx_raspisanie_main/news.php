<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>



<div class="<?if($arParams['CHANGE_BOOTSTRAP'] == 'Y'):?>changebtstrp<?endif;?> sched">
    <div class='container'>
        <div class='row'>
            <div class="mibok-wrapper">
                <?if($arParams["USE_FILTER"]=="Y"):?>

                <?$APPLICATION->IncludeComponent(
                    "mx_mibok:rasp.timetable.filter",
                    ".default",
                    Array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                        "FILTER_DATE_RANGE" => $arParams["FILTER_DATE_RANGE"],
                        "FILTER_ALL_VALUE" => $arParams["FILTER_ALL_VALUE"],
                        "FILTER_MAIN_HEADER" => $arParams["FILTER_MAIN_HEADER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "SIGN_HEAD" => $arParams["SIGN_HEAD"],
                        //"PAGER_PARAMS_NAME" => "arrPager",
                    ),
                    $component   
                );?>
                <?endif?>
<?
$GLOBALS['arrMibokTt'] = array_merge($GLOBALS['arrMibokTt'], array("PROPERTY_SHOW_VALUE" => "Y"));
?>

                <?$APPLICATION->IncludeComponent(
                    "mx_mibok:rasp.timetable.list",
                    "mx_default",
                    Array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                        "SET_TITLE" => $arParams["SET_TITLE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                        "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                        "FILTER_NAME" => $arParams["FILTER_NAME"],

                        "LIST_SETTINGS_NAME" => $arParams["LIST_SETTINGS_NAME"],
                        "LIST_SETTINGS_PROP1" => $arParams["LIST_SETTINGS_PROP1"],
                        "LIST_SETTINGS_PROP2" => $arParams["LIST_SETTINGS_PROP2"],
                        "LIST_SETTINGS_MODAL_NAME" => $arParams["LIST_SETTINGS_MODAL_NAME"],
                        "LIST_SETTINGS_MODAL_FIELD_CODE" => $arParams["LIST_SETTINGS_MODAL_FIELD_CODE"],
                        "LIST_SETTINGS_MODAL_PROPERTY_CODE" => $arParams["LIST_SETTINGS_MODAL_PROPERTY_CODE"],

                        "IBLOCK_TYPE_RECORD" => $arParams["IBLOCK_TYPE_RECORD"],
                        "IBLOCK_ID_RECORD" => $arParams["IBLOCK_ID_RECORD"],
                        "EVENT_MESSAGE_ID" => $arParams["EVENT_MESSAGE_ID"],

                        "AJAX_MODE" => $arParams["AJAX_MODE"],
                        "AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
                        "AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
                        "AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
                        "AJAX_OPTION_ADDITIONAL" => $arParams["AJAX_OPTION_ADDITIONAL"],
                        "PROPERTY_CODES_RECORD" => $arParams['PROPERTY_CODES_RECORD'],
                        "PROPERTY_CODES_RECORD_REQUIRED" => $arParams['PROPERTY_CODES_RECORD_REQUIRED'],
                        
                        "SIGN_HEAD" => $arParams["SIGN_HEAD"],
                        "SIGN_RECORD" => $arParams["SIGN_RECORD"],
                        "SIGN_RECORD_OK" => $arParams["SIGN_RECORD_OK"],
                        "SIGN_RECORD_BACK" => $arParams["SIGN_RECORD_BACK"],
                        "SIGN_FILTER" => $arParams["SIGN_FILTER"],
                        "SIGN_NO_DAY" => $arParams["SIGN_NO_DAY"],
                        
                        "USER_CONSENT" => $arParams["USER_CONSENT"],
                        "USER_CONSENT_ID" => $arParams["USER_CONSENT_ID"],
                        "USER_CONSENT_IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                        "USER_CONSENT_IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
                    ),
                    $component
                );?>
            </div>
        </div>
    </div>
</div>