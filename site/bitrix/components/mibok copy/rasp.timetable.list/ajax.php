<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?IncludeModuleLangFile(__FILE__);?>

<?use Bitrix\Main\Loader,
    Bitrix\Main\Entity,
    Bitrix\Iblock;
$module_id = "mibok.rasp";
if(!IsModuleInstalled($module_id))
    return;
Loader::includeModule('iblock');
$loadRes = Loader::includeSharewareModule($module_id);
if($loadRes == 0 || $loadRes == 3)
    return;
use Mibok\Rasp\CounterTimeTable;?>

<?if(!isset($_POST['ACTION']))
{
    $arConsent = array();
    $arConsent = (array) json_decode($_POST['CONSENT']);
}
$arSign = array();
if(isset($_POST['SIGN']) && !empty($_POST['SIGN']))
    $arSign = (array) json_decode($_POST['SIGN']);

if(LANG_CHARSET == 'windows-1251')
{
    $arSign['SIGN_RECORD'] = mb_convert_encoding($arSign['SIGN_RECORD'], "Windows-1251", "UTF-8");
//    $arSign['SIGN_RECORD_OK'] = mb_convert_encoding($arSign['SIGN_RECORD_OK'], "Windows-1251", "UTF-8");
//    $arSign['SIGN_RECORD_BACK'] = mb_convert_encoding($arSign['SIGN_RECORD_BACK'], "Windows-1251", "UTF-8");
}
//p($arSign);
?>

<?if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'GetLimit'):
    foreach($_POST['ITEMS'] as $key => $val)
    {
        $arId[] = $val['ELEMENT_ID'];
    }
    $arId = array_unique($arId);
    
    $dbEl = CIBlockElement::GetList(Array(), array('IBLOCK_ID' => $_POST['IBLOCK_ID'], 'ID' => $arId), false, false, array('ID', 'PROPERTY_LIMIT'));
    while($arEl = $dbEl->Fetch())
    {
        $arCount['iblock'][$arEl['ID']] = $arEl['PROPERTY_LIMIT_VALUE'];
    }
    
    foreach($_POST['ITEMS'] as $key => $val)
    {
        $time_info = json_decode($val['TIME_INFO']);
        $resCounter = CounterTimeTable::getList(array(
            'select' => array('CNT'),
            'filter' => array(
                "=ELEMENT_ID" => $val['ELEMENT_ID'],
                "=LESSON_BEGIN" => $time_info[0],
                "=LESSON_END" => $time_info[1],
                "=LESSON_DAY" => $time_info[2],
            ),
            'runtime' => array(
                new Entity\ExpressionField('CNT', 'COUNT(*)')
            )
        ))->fetch();
        $id = $val['ELEMENT_ID'].'_'.$time_info[2];
        if($resCounter['CNT'] >= $arCount['iblock'][$val['ELEMENT_ID']])
            $class = 'no-item-record';
        else
            $class = '';
        $arRes[] = array('iblock' => $arCount['iblock'][$val['ELEMENT_ID']], 'table' => $resCounter['CNT'], 'class' => $class, 'id' => $id);
       
    }
    echo json_encode($arRes);
    
?>

<?elseif(isset($_POST['ACTION']) && $_POST['ACTION'] == 'GetLimitOne'):
    $arRes = array();
    $dbPropRec = CIBlockElement::GetProperty($_POST["IBLOCK_ID"], $_POST['ELEMENT_ID'], array("sort" => "asc"), array("CODE" => "LIMIT"));
    if($arPropRec = $dbPropRec->Fetch())
    {
        if(isset($arPropRec['VALUE']) && $arPropRec['VALUE'] > 0)
        {
            $arRes['iblock'] = $arPropRec['VALUE'];
            $time_info = json_decode($_POST['TIME_INFO']);
            $resCounter = CounterTimeTable::getList(array(
                'select' => array('CNT'),
                'filter' => array(
                    "=ELEMENT_ID" => $_POST['ELEMENT_ID'],
                    "=LESSON_BEGIN" => $time_info[0],
                    "=LESSON_END" => $time_info[1],
                    "=LESSON_DAY" => $time_info[2],
                ),
                'runtime' => array(
                    new Entity\ExpressionField('CNT', 'COUNT(*)')
                )
            ))->fetch();
            $arRes['table'] = $resCounter['CNT'];
            if($arRes['table'] >= $arRes['iblock'])
                $arRes['class'] = 'no-item-record';
            else
                $arRes['class'] = '';
        }
    }
    echo json_encode($arRes);
?>

<?elseif(isset($_POST['ACTION']) && $_POST['ACTION'] == 'CancelRecord'):?>
    <?
    $bUsermanager = false;
    $result = \Bitrix\Main\GroupTable::getList(array(
        'select'  => array('NAME','ID'), 
        'filter'  => array('STRING_ID' => 'mibok_view_reservation')
    ));
    if ($arGroup = $result->fetch()) 
    {
        $groupView = $arGroup['ID'];
        $result = \Bitrix\Main\UserGroupTable::getList(array(
            'filter' => array('GROUP_ID' => $arGroup['ID'],'USER.ACTIVE'=>'Y'),
            'select' => array('USER_ID'),
        ));
        $userId = $USER->GetId();
        while ($resUser = $result->fetch()) 
        {
            if($userId == $resUser['USER_ID'])
                $bUserManager = true;
        }
    }
    if($bUserManager)
    {
        $bError = false; 
        $resCounter = CounterTimeTable::getList(array(
                    'select' => array('*'),
                    'filter' => array(
                        "=ID" => $_POST['ID_TBL'],
                    )
                ))->fetch();
        if($resCounter['TYPE'] == 'site' && $_POST['ID_IBLOCK'] != 0)
        {
            if(!CIBlockElement::Delete($_POST['ID_IBLOCK']))
                $bError = true;
        }
        $result = CounterTimeTable::delete($_POST['ID_TBL']);
        if (!$result->isSuccess())
        {
             $bError = true;
        }
        if(!$bError)
        {
            $arRes['success'] = 'ok';
            //$arRes['td-info'] = GetMessage('MIBOK_ADMIN_RECORDS_FREE').'<br><a href="#" class="admin-show-comment" >'.GetMessage('MIBOK_ADMIN_RECORDS_ADD_COMMENT').'</a> <textarea class="form-control hidden" placeholder="'.GetMessage('MIBOK_ADMIN_RECORDS_COMMENT').'"></textarea>';
            //$arRes['td-btn'] = '<a href="#" class="btn btn-default admin-record-add">'.GetMessage('MIBOK_ADMIN_RECORDS_ADD').'</a>';
        }
        else
            $arRes['success'] = 'error';
        //p($arRes);
        echo json_encode($arRes);
    }
    ?>
<?elseif(isset($_POST['ACTION']) && $_POST['ACTION'] == 'AddRecordAdmin'):?>
    <?
    $bUsermanager = false;
    $result = \Bitrix\Main\GroupTable::getList(array(
        'select'  => array('NAME','ID'), 
        'filter'  => array('STRING_ID' => 'mibok_view_reservation')
    ));
    if ($arGroup = $result->fetch()) 
    {
        $groupView = $arGroup['ID'];
        $result = \Bitrix\Main\UserGroupTable::getList(array(
            'filter' => array('GROUP_ID' => $arGroup['ID'],'USER.ACTIVE'=>'Y'),
            'select' => array('USER_ID'),
        ));
        $userId = $USER->GetId();
        while ($resUser = $result->fetch()) 
        {
            if($userId == $resUser['USER_ID'])
                $bUserManager = true;
        }
    }
    if($bUserManager)
    {
        $arTimeInfo = json_decode($_POST['TIME_INFO']);
        $dateRec  = date('d.m.y H:i:s');
        
        $postComment = htmlspecialcharsbx($_POST['COMMENT']);
        if(LANG_CHARSET == 'windows-1251')
        {
            $postComment = mb_convert_encoding($postComment, "Windows-1251", "UTF-8");
        }
        
        $result = CounterTimeTable::add(array(
            "ELEMENT_ID" => $_POST['ELEMENT_ID'],
            "LESSON_BEGIN" => $arTimeInfo[0],
            "LESSON_END" => $arTimeInfo[1],
            "LESSON_DAY" => $arTimeInfo[2],
            "TYPE" => 'admin',
            "COMMENT" => nl2br($postComment),
            'DATE_BLOCK' => $dateRec
        ));

        if (!$result->isSuccess())
        {
            $arRes['success'] = 'error';
        }
        else
        {
            $id = $result->getId();
            $arRes['success'] = 'ok';
            
            $arRes['td-info'] = '<b>'.$dateRec.'</b><br><small>'.GetMessage('MIBOK_ADMIN_RECORDS_BLOCK').'</small><br>';
            $arRes['td-btn'] = '<a href="#" class="btn btn-default admin-record-cancel" data-recordtbl="'.$id.'" data-recordiblock="0">'.GetMessage('MIBOK_ADMIN_RECORDS_CANCEL').'</a>';
        }
        if(LANG_CHARSET == 'windows-1251')
        {
            $arRes['td-info']  = mb_convert_encoding($arRes['td-info'] , "UTF-8",  "Windows-1251" );
            $arRes['td-btn']  = mb_convert_encoding($arRes['td-btn'] , "UTF-8",  "Windows-1251" );
        }
        echo json_encode($arRes);
    }
    ?>

<?elseif(!isset($_POST['iblock_submit']) && isset($_POST) && !empty($_POST)):?>
    <?$APPLICATION->IncludeComponent("mibok:rasp.timetable.detail", ".default", array_merge(Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_ELEMENT_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "AJAX_OPTION_SHADOW" => "Y",
            "BROWSER_TITLE" => "-",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "CHECK_DATES" => "N",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_CODE" => "",
            "ELEMENT_ID" => $_POST["ELEMENT_ID"],
            "FIELD_CODE" => json_decode($_POST["FIELD"]),
            "IBLOCK_ID" => $_POST["IBLOCK_ID"],
            "IBLOCK_TYPE" => $_POST["IBLOCK_TYPE"],	
            "IBLOCK_URL" => "",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "MESSAGE_404" => "",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "",
            "PROPERTY_CODE" => json_decode($_POST["PROPERTY"]), 
            "SET_BROWSER_TITLE" => "Y",
            "SET_CANONICAL_URL" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "USE_PERMISSIONS" => "N",
            "USE_SHARE" => "N",
            "COMPONENT_TEMPLATE" => "mibok-modal",
            "MODAL_NAME" => $_POST["MODAL_NAME"],
            "TIME_INFO" => json_decode($_POST["TIME_INFO"]),
            "MODAL_DATA" => json_decode($_POST["MODAL_DATA"]),
            "PROP_RECORD" => json_decode($_POST["PROP_RECORD"]),
            "PROP_RECORD_REQ" => json_decode($_POST["PROP_RECORD_REQ"]),
            "RECORD_PARAM" => json_decode($_POST["RECORD_PARAM"]),
            "IS_RECORD" => $_POST["IS_RECORD"],
            "SIGN_RECORD" =>  $arSign['SIGN_RECORD'],
        ), $arConsent),
        false
    );?>
<?elseif(isset($_POST['iblock_submit'])):
    ?>
     <?$APPLICATION->IncludeComponent(
        "mibok:rasp.element.add", 
        ".default", 
        array_merge(array(
            "AJAX_MODE" => "Y",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "ALLOW_DELETE" => "N",
            "ALLOW_EDIT" => "N",
            "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
            "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
            "CUSTOM_TITLE_DETAIL_PICTURE" => "",
            "CUSTOM_TITLE_DETAIL_TEXT" => "",
            "CUSTOM_TITLE_IBLOCK_SECTION" => "",
            "CUSTOM_TITLE_NAME" => '',
            "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
            "CUSTOM_TITLE_PREVIEW_TEXT" => '',
            "CUSTOM_TITLE_TAGS" => "",
            "DEFAULT_INPUT_SIZE" => "30",
            "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
            "ELEMENT_ASSOC" => "CREATED_BY",
            "GROUPS" => array(
                0 => "2",
            ),
            "IBLOCK_ID" => $_POST['IBLOCK_ID'],
            "IBLOCK_TYPE" => $_POST['IBLOCK_TYPE'],
            "LEVEL_LAST" => "N",
            "MAX_FILE_SIZE" => "0",
            "MAX_LEVELS" => "100000",
            "MAX_USER_ENTRIES" => "100000",
            "NAV_ON_PAGE" => "0",
            "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
            "PROPERTY_CODES" => json_decode($_POST['PROPERTY_CODES']),
            "PROPERTY_CODES_REQUIRED" => json_decode($_POST['PROPERTY_CODES_REQUIRED']),
            "RESIZE_IMAGES" => "N",
            "SEF_MODE" => "N",
            "STATUS" => "INACTIVE",
            "STATUS_NEW" => "N",
            "USER_MESSAGE_ADD" => GetMessage('FORM_OK'),
            "USER_MESSAGE_EDIT" => "",
            "USE_CAPTCHA" => "N",
            "COMPONENT_TEMPLATE" => ".default",
            "EVENT_MESSAGE_ID" => json_decode($_POST['EVENT_MESSAGE_ID']),
        ), $arConsent),
        false
    );?>

<?elseif(isset($_GET['strIMessage'])):?>
    <div class="mibok-wrapper-success" style="display: block;">
        <div class="mibok-success">
            <?=htmlspecialcharsbx($_GET['strIMessage'])?>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-mibok" data-dismiss="modal"><?=GetMessage('FORM_BACK')?></button>
        </div>
    </div>
<?endif;?>