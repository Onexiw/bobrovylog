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
$this->setFrameMode(true);
?>


<?
$date = date('j',$arParams['TIME_INFO'][2]);
$month = MibokRasp::ruDateFull("F", $arParams['TIME_INFO'][2]);
$day = MibokRasp::ruDateFull("l", $arParams['TIME_INFO'][2]);

$nameLes = '';
if(strpos($arParams['MODAL_NAME'], 'PROPERTY_') === false)
    $nameLes = $arResult['FIELDS'][$arParams['MODAL_NAME']];
else
    $nameLes = $arResult['DISPLAY_PROPERTIES'][str_replace('PROPERTY_','',$arParams['MODAL_NAME'])]['DISPLAY_VALUE'];

$text = $date.' '.$month.' '.$arParams['TIME_INFO'][0].' - '.$arParams['TIME_INFO'][1]."\n";

foreach($arParams['MODAL_DATA'] as $item)
{
    if(strpos($item, 'PROPERTY_') === false)
    {
        if(isset($arResult[$item]) && !empty($arResult[$item]))
        {
            $text .= GetMessage("IBLOCK_FIELD_".$item).': '.$arResult[$item];
        }
    }
    else
    {
        $item = str_replace('PROPERTY_', '', $item);
        if(isset($arResult["DISPLAY_PROPERTIES"][$item]) && !empty($arResult["DISPLAY_PROPERTIES"][$item]["DISPLAY_VALUE"]))
        {
            $text .= $arResult["DISPLAY_PROPERTIES"][$item]["NAME"].': ';

            if(is_array($arResult["DISPLAY_PROPERTIES"][$item]["DISPLAY_VALUE"]))
                $text .= strip_tags(implode("&nbsp;/&nbsp;", $arResult["DISPLAY_PROPERTIES"][$item]["DISPLAY_VALUE"]));
            else
                $text .= strip_tags($arResult["DISPLAY_PROPERTIES"][$item]["DISPLAY_VALUE"]);
        }
        elseif(isset($arResult["PROPERTIES"][$item]) && !empty($arResult["PROPERTIES"][$item]["VALUE"]))
        {
            $text .= $arResult["PROPERTIES"][$item]["NAME"].': ';
            if(is_array($arResult["PROPERTIES"][$item]["VALUE"]))
                $text .= strip_tags(implode("&nbsp;/&nbsp;", $arResult["PROPERTIES"][$item]["VALUE"]));
            else
                $text .= strip_tags($arResult["PROPERTIES"][$item]["VALUE"]);
        }
    }
    $text .= "\n";
}
?>

<div class="modal-header">
    <span class="ic-m-t-close close" data-dismiss="modal" aria-hidden="true"></span>
    <h4 class="modal-title" id="myModalLabel"><?=$nameLes?></h4>
    <div class="modal-title-info">
		<?if($arParams['TIME_INFO'][0] != '00.00' && $arParams['TIME_INFO'][1]  != '00.00'):?>
			<span class="ic-m-t-clock modal-title-time"><?=$arParams['TIME_INFO'][0]?> - <?=$arParams['TIME_INFO'][1]?></span>
		<?endif;?>
		<span class="modal-title-date"> <?=$date?> <?=$month?></span> 
		<span class="modal-title-day"><?=$day?></span>
    </div>
</div>
<div class="modal-body mibok-dropdown">
    <div class="modal-wrapper-info">
        <table class="table">
            <?foreach($arResult["FIELDS"] as $code=>$value):
                if($code != $arParams['MODAL_NAME'] && !empty($value) && $code != 'ACTIVE_FROM' && $code != 'ACTIVE_TO'):
                ?>
                <tr>
                    <?if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
                    {
                        ?>
                        <td><span class='modal-name-category'><?=GetMessage("IBLOCK_FIELD_".$code)?></span></td>
                            <?
                        if (!empty($value) && is_array($value))
                        {
                            ?><td><img border="0" src="<?=$value["SRC"]?>"></td><?
                        }
                    }
                    else
                    {?>
                        <td><span class='modal-name-category'><?=GetMessage("IBLOCK_FIELD_".$code)?></span></td>
                        <td><span class='modal-value-category'><?=$value;?></span></td>
                    <?
                    }
                    ?>
                </tr>
                <?endif;?>
            <?endforeach;?>
            <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
                if($pid != str_replace('PROPERTY_','',$arParams['MODAL_NAME']) && !empty($arProperty["DISPLAY_VALUE"])):
                ?>
                <tr>
                    <?if($pid == 'COLOR' || $pid == 'PERIOD'):
                        continue;?>
                    <?else:?>
                        <td><span class='modal-name-category'><?=$arProperty["NAME"]?></span></td>
                        <td><span class='modal-value-category'>
                            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                <?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
                            <?else:?>
                                <?=$arProperty["DISPLAY_VALUE"];?>
                            <?endif?>
                        </span></td>
                    <?endif;?>
                </tr>
                <?endif?>
            <?endforeach;?>
        </table>
        <input type='hidden' name='AJAX_COUNTER_IBLOCK_ID' value='<?=$arParams['IBLOCK_ID']?>'>
        <input type='hidden' name='AJAX_COUNTER_ELEMENT_ID' value='<?=$arParams['ELEMENT_ID']?>'>
        <input type='hidden' name='AJAX_COUNTER_TIME_INFO' value='<?=json_encode($arParams['TIME_INFO'])?>'>
        <input type='hidden' name='AJAX_COUNTER_TMSTMP' value='<?=$arParams['TIME_INFO'][2]?>'>
    </div>
</div>

<?if(!$arResult['IS_VIEW_RECORD']):?>
<? $tmp = $arParams['TIME_INFO'][2];?>
<?if( (date('j') > date('j', $tmp) && date('n') >= date('n', $tmp) && date('Y') >= date('Y', $tmp)) || (date('j') < date('j', $tmp) && date('n') > date('n', $tmp) && date('Y') >= date('Y', $tmp)) ):?>

    <div class="modal-footer no-record"></div>
<?elseif(isset($arParams['IS_RECORD']) && $arParams['IS_RECORD'] =='Y' && $arResult['CAN_RECORD']):?>
    <div class="modal-footer">
        <button type="button" class="btn btn-mibok mibok-show-form"><?=($arParams['SIGN_RECORD'] ? $arParams['SIGN_RECORD'] : GetMessage('RECORD_LESSON'))?></button>
        <?$APPLICATION->IncludeComponent(
                           "mibok:rasp.element.add", 
                           ".default", 
                           array(
                               "AJAX_MODE" => "Y",
                               "AJAX_OPTION_ADDITIONAL" => "",
                               "AJAX_OPTION_HISTORY" => "N",
                               "AJAX_OPTION_JUMP" => "N",
                               "AJAX_OPTION_STYLE" => "Y",
                               "ALLOW_DELETE" => "N",
                               "ALLOW_EDIT" => "N",
                               "AJAX_OPTION_SHADOW" => "Y",
                               "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                               "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                               "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                               "CUSTOM_TITLE_DETAIL_TEXT" => "",
                               "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                               "CUSTOM_TITLE_NAME" => GetMessage('FORM_NAME'),
                               "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
                               "CUSTOM_TITLE_PREVIEW_TEXT" => GetMessage('FORM_TEXT'),
                               "CUSTOM_TITLE_TAGS" => "",
                               "DEFAULT_INPUT_SIZE" => "30",
                               "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                               "ELEMENT_ASSOC" => "CREATED_BY",
                               "GROUPS" => array(
                                   0 => "2",
                               ),
                               "IBLOCK_ID" => $arParams['RECORD_PARAM'][1],
                               "IBLOCK_TYPE" => $arParams['RECORD_PARAM'][0],
                               "LEVEL_LAST" => "N",
                               "MAX_FILE_SIZE" => "0",
                               "MAX_LEVELS" => "100000",
                               "MAX_USER_ENTRIES" => "100000",
                               "NAV_ON_PAGE" => "0",
                               "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                               "PROPERTY_CODES" => $arParams['PROP_RECORD'],
                               "PROPERTY_CODES_REQUIRED" => $arParams['PROP_RECORD_REQ'],
                               "RESIZE_IMAGES" => "N",
                               "SEF_MODE" => "N",
                               "STATUS" => "INACTIVE",
                               "STATUS_NEW" => "N",
                               "USER_MESSAGE_ADD" => GetMessage('FORM_OK'),
                               "USER_MESSAGE_EDIT" => "",
                               "USE_CAPTCHA" => "N",
                               "COMPONENT_TEMPLATE" => ".default",
                               "EVENT_MESSAGE_ID" => array(
                                   0 => $arParams['RECORD_PARAM'][2],
                               ),
                               'TEXT_INFO' => $text,
                               
                                "USER_CONSENT" => $arParams["USER_CONSENT"],
                                "USER_CONSENT_ID" => $arParams["USER_CONSENT_ID"],
                                "USER_CONSENT_IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                                "USER_CONSENT_IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
                               
                               "RECORD_IBLOCK_ID" => $arParams['IBLOCK_ID'],
                               "RECORD_ELEMENT_ID" => $arParams['ELEMENT_ID'],
                               "RECORD_TIME_INFO" => $arParams['TIME_INFO'],
                           ),
                           false
                       );?>

    </div>
<?elseif(isset($arParams['IS_RECORD']) && $arParams['IS_RECORD'] =='Y' && !$arResult['CAN_RECORD'] && $arResult['RECORD_INFO']):?>
    <div class="modal-footer">
        <div class="mibok-wrapper-success" style="display: block;">
            <div class="mibok-success">
                <span class='mibok-close-record'><?=GetMessage('MIBOK_RECORD_INFO');?></span>
            </div>
        </div>
    </div>
<?else:?>
    <div class="modal-footer no-record"></div>
<?endif;?>
<?else:?>
        <div class="modal-footer modal-footer-admin">
            <div class="mibok-form-name"><?=GetMessage('MIBOK_ADMIN_RECORDS');?></div>
            <?if(!empty($arResult['RECORD_INFO_MANAGER']['LIMIT'])):?>
                <?=GetMessage('MIBOK_ADMIN_RECORDS_LIMIT');?> <?=$arResult['RECORD_INFO_MANAGER']['LIMIT']?><br>
                <input type="hidden" value="<?=$arResult['RECORD_INFO_MANAGER']['LIMIT']?>" name="admin-limit-info">
            <?endif;?>
            <?//if($arResult['RECORD_INFO_MANAGER']['REAL_CNT'] > 0):?>
            <br>
            <?if(isset($arResult['RECORD_INFO_MANAGER']['RECORDS_TBL']) && count($arResult['RECORD_INFO_MANAGER']['RECORDS_TBL']) > 0):?>
                <div class="modal-wrapper-info">
                    <table class="table table-bordered">
                        <?$iRecord = 0;

                        foreach($arResult['RECORD_INFO_MANAGER']['RECORDS_TBL'] as $key => $arRecordTBL):
                            $iRecord = $key + 1;
                            ?>
                            <tr class="danger1">
                                <td><?=$iRecord?></td>
                            <?if($arRecordTBL['TYPE'] == 'site'):
                                $arRecord = $arResult['RECORD_INFO_MANAGER']['RECORDS_IBLOCK'][$arRecordTBL['RECORD_ID']];?>
                                    <td class="td-block"><b><?=($arRecordTBL['DATE_BLOCK'] ? $arRecordTBL['DATE_BLOCK'] : $arRecord['DATE_ACTIVE_FROM'])?></b><br>
                                        <?foreach($arRecord['PROP'] as $arPropRec):?>
                                            <?=$arPropRec['NAME']?>: <?=$arPropRec['VALUE']?><br>
                                        <?endforeach;?>
                                        <?=$arRecord['PREVIEW_TEXT']?>
                                    </td>
                                <?elseif($arRecordTBL['TYPE'] == 'admin'):?>
                                    <td class="td-block"><b><?=$arRecordTBL['DATE_BLOCK']?></b><br>
                                        <small><?=GetMessage('MIBOK_ADMIN_RECORDS_BLOCK');?></small><br>
                                        <?if(!empty($arRecordTBL['COMMENT'])):?>
                                            <?=$arRecordTBL['COMMENT']?>
                                        <?endif;?>
                                    </td>
                                <?else:?>
                                    <td><?=GetMessage('MIBOK_ADMIN_RECORDS_NO_DATA_ITEM')?></td>
                                <?endif;?>
                                    <td class="td-block-btn"><a href="#" class="btn btn-default admin-record-cancel" data-recordtbl="<?=$arRecordTBL['ID']?>" data-recordiblock="<?=($arRecordTBL['TYPE'] == 'site' ? $arRecord['ID'] : 0)?>"><?=GetMessage('MIBOK_ADMIN_RECORDS_CANCEL');?></a></td>
                                </tr>
                        <?endforeach?>
                        
                        <?$bHiddenAdd = false;
                        if(!empty($arResult['RECORD_INFO_MANAGER']['REAL_CNT']) && !empty ($arResult['RECORD_INFO_MANAGER']['LIMIT']))
                        {
                            if($arResult['RECORD_INFO_MANAGER']['REAL_CNT'] >= $arResult['RECORD_INFO_MANAGER']['LIMIT'])
                                $bHiddenAdd = true;
                        }
                        ?>

                    <tr class="success tr-add-admin <?if($bHiddenAdd):?> hidden <?endif;?>">
                        <td></td>
                        <td class="td-free">
                            <?=GetMessage('MIBOK_ADMIN_RECORDS_FREE');?>
                            <br>
                            <textarea class='form-control' placeholder="<?=GetMessage('MIBOK_ADMIN_RECORDS_COMMENT');?>"></textarea>
                        </td>
                        <td class="td-free-btn"><a href="#" class="btn btn-default admin-record-add" ><?=GetMessage('MIBOK_ADMIN_RECORDS_ADD');?></a></td>
                    </tr>
                       
                    </table>
                </div>
            <?else:?>
                <p class="alert alert-warning">
                    <?= GetMessage('MIBOK_ADMIN_RECORDS_NO_DATA')?>
                </p>
                <table class="table table-bordered">
                    <tr class="success tr-add-admin">
                        <td></td>
                        <td class="td-free">
                            <?=GetMessage('MIBOK_ADMIN_RECORDS_FREE');?>
                            <br>
                            <textarea class='form-control' placeholder="<?=GetMessage('MIBOK_ADMIN_RECORDS_COMMENT');?>"></textarea>
                        </td>
                        <td class="td-free-btn"><a href="#" class="btn btn-default admin-record-add" ><?=GetMessage('MIBOK_ADMIN_RECORDS_ADD');?></a></td>
                    </tr>
                </table>
            <?endif;?>
            <br>
        </div>
<? endif; ?>



