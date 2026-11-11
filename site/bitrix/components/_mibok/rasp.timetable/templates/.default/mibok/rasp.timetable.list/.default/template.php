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
//p($arParams);
?>
<?$arPeriodNo = $arResult['PERIOD_DAY_NO'];?>
<?if(count($arResult['ITEMS']) > 0):?>
    <div class="mibok-wrapper-grid mibok-preloader">
        <div class="mibok-grid-bg" >
            <div class="owl-carousel owl-theme mibok-carousel-day">
                    <?$keyNext = -1;
                    foreach($arResult['PERIOD_DAY_NO'] as $key => $item):

                        $nextDay = next($arResult['PERIOD_DAY_NO']);
                        if($keyNext == $key)
                            continue;
                    $date = date('j',$item['tmp']);
                    $month = MibokRasp::ruDateFull("M", $item['tmp']);
                    $day = MibokRasp::ruDateFull("D", $item['tmp']);
                    ?>

                    <?if($item['class'] != 'day-no'):
                    ?>
                        <div class="item  <?=$item['class']?>">
                            <div class="item-day"><span class="main-sign"><?=$date?></span> <?=$month?>, <span class="main-sign"><?=$day;?></span></div>
                        </div>
                    <?else:?>
                        <?if(isset($arResult['INFO_DAY'][$key-1]) && $arResult['INFO_DAY'][$key-1]['class'] == 'day-no'):
                            continue;
                            //elseif(isset($arResult['INFO_DAY'][$key+1]) && $arResult['INFO_DAY'][$key+1]['class'] == 'day-no'):
                            elseif(isset($nextDay) && $nextDay['class'] == 'day-no'):
//                                $date2 = date('j',$arResult['INFO_DAY'][$key+1]['tmp']);
//                                $month2 = MibokRasp::ruDateFull("M", $arResult['INFO_DAY'][$key+1]['tmp']);
                                $date2 = date('j',$nextDay['tmp']);
                                $month2 = MibokRasp::ruDateFull("M", $nextDay['tmp']);
                                $keyNext = key($arResult['PERIOD_DAY_NO']);
                                ?>
                            <div class="item  <?=$item['class']?>">
                                <div class="item-day"><span class="main-sign"><?=$date?></span> <?=$month?> - <span class="main-sign"><?=$date2?></span> <?=$month2?></div>
                            </div>
                        <?else/*if(!isset($arResult['INFO_DAY'][$key+1]) && !isset($arResult['INFO_DAY'][$key-1]))*/:?>
                            <div class="item  <?=$item['class']?>">
                                <div class="item-day"><span class="main-sign"><?=$date?></span> <?=$month?>, <span class="main-sign"><?=$day;?></span></div>
                            </div>
                        <?endif;?>
                    <?endif?>
                <?endforeach;?>
            </div>
        </div>
        
        <div class="owl-carousel owl-theme mibok-carousel-lessons">
            <?$keyNext = -1; 
            foreach($arResult['PERIOD_DAY_NO'] as $key => $item):
                $nextDay = next($arPeriodNo);
                if($keyNext == $key)
                    continue;
                ?>
                <?if($item['class'] != 'day-no'):?>
                    <div class="item <?=$item['class']?>">
                        <?if(isset($arResult['TABLE'][date('n',$item['tmp'])][date('j',$item['tmp'])])):?>
                            <?foreach($arResult['TABLE'][date('n',$item['tmp'])][date('j',$item['tmp'])] as $arHour):?>
                                <?foreach($arHour as $arLesson):
                                    $prop_name = '';
                                    $prop1 = '';
                                    $prop2 = '';
                                ?>
                                <?//p($arLesson);
                                ?>
                                    <div class="item-lesson <?=$arLesson['PROPERTY_COLOR']?>" data-class-color=" <?=$arLesson['PROPERTY_COLOR']?>" data-id="<?=$arLesson['ID']?>" data-tmstmp="<?=$item['tmp']?>">
                                        <div class="mibok-time">
											<?if($arLesson['BEGIN'] != '00.00' && $arLesson['END']  != '00.00'):?>
												<span class='lesson-time-info'><?=$arLesson['BEGIN']?> - <?=$arLesson['END']?></span>
											<?endif;?>
                                            <?if($arLesson['IBLOCK_LIMIT'] > 0 && $item['class'] != 'day-past'/*&& isset($arResult['OPTIONS']['rec_timetable']) && $arResult['OPTIONS']['rec_timetable'] =='Y'*/):?>
                                                <span data-rasp-id="<?=$arLesson['ID']?>_<?=$item['tmp']?>" class='count-rasp <?if($arLesson['IBLOCK_LIMIT'] == $arLesson['TABLE_LIMIT']):?>no-item-record<?endif;?>'>
                                                    <?=$arLesson['TABLE_LIMIT']?>/<?=$arLesson['IBLOCK_LIMIT']?>
                                                </span>
                                            <?elseif($arLesson['IBLOCK_LIMIT'] == '-1' && $item['class'] != 'day-past'):?>
                                                <span class='stop-record no-item-record'></span>
                                            <?endif;?>
                                        </div>
                                        <?if(!empty($arLesson[$arParams['LIST_SETTINGS_NAME']])):?>
                                             <?if(is_array($arLesson[$arParams['LIST_SETTINGS_NAME']]))
                                                $prop_name = strip_tags(implode("&nbsp;/&nbsp;", $arLesson[$arParams['LIST_SETTINGS_NAME']]));
                                            else
                                                $prop_name = strip_tags($arLesson[$arParams['LIST_SETTINGS_NAME']]);?>
                                            <div class="mibok-name-lesson"><?=$prop_name?></div>
                                        <?endif;?>
                                        <?if(!empty($arLesson[$arParams['LIST_SETTINGS_PROP1']])):?>
                                            <?if(is_array($arLesson[$arParams['LIST_SETTINGS_PROP1']]))
                                                $prop1 = strip_tags(implode("&nbsp;/&nbsp;", $arLesson[$arParams['LIST_SETTINGS_PROP1']]));
                                            else
                                                $prop1 = strip_tags($arLesson[$arParams['LIST_SETTINGS_PROP1']]);?>
                                            <div class="mibok-name-place"><?=$prop1?></div>
                                        <?endif;?>
                                        <?if(!empty($arLesson[$arParams['LIST_SETTINGS_PROP1']])):?>
                                            <?if(is_array($arLesson[$arParams['LIST_SETTINGS_PROP2']]))
                                                $prop2 = strip_tags(implode("&nbsp;/&nbsp;", $arLesson[$arParams['LIST_SETTINGS_PROP2']]));
                                            else
                                                $prop2 = strip_tags($arLesson[$arParams['LIST_SETTINGS_PROP2']]);?>
                                            <div class="mibok-name-teacher"><?=$prop2?></div>
                                        <?endif;?>
                                        <input type="hidden" name="TIME_INFO" value='<?=json_encode(array($arLesson['BEGIN'], $arLesson['END'],$item['tmp']))?>'> 
                                        <div class="mibok-hover-lesson" data-toggle="modal" data-target="#mibok-timetableModal"><span class='btn btn-mibok mibok-modal-timetable' ><?=GetMessage('MODAL_SHOW')?></span></div>
                                    </div>
                                <?endforeach?>
                            <?endforeach;?>
                        <?endif;?>
                    </div>
                <?else:?>
                    <?if(isset($arResult['INFO_DAY'][$key-1]) && $arResult['INFO_DAY'][$key-1]['class'] == 'day-no'):
                        continue;
//                    elseif(isset($arResult['INFO_DAY'][$key+1]) && $arResult['INFO_DAY'][$key+1]['class'] == 'day-no'):
//                        $date1 = date('d.m',$arResult['INFO_DAY'][$key]['tmp']);
//                        $date2 = date('d.m',$arResult['INFO_DAY'][$key+1]['tmp']);
                        elseif(isset($nextDay) && $nextDay['class'] == 'day-no'):
                            $date1 = date('d.m',$arResult['INFO_DAY'][$key]['tmp']);
                            $date2 = date('d.m',$nextDay['tmp']);
                            $keyNext = key($arResult['PERIOD_DAY_NO']);
                        ?>
                        <div class="item <?=$item['class']?>">
                            <?for($i=0; $i < $arResult['COUNT_LESSONS']; $i++):?>
                                <?if($i % 2 == 0):?>
                                    <div class="item-lesson">
                                        <div class=""><?=($arParams['SIGN_NO_DAY'] ? $arParams['SIGN_NO_DAY']  : GetMessage('LESSONS_NO'))?></div>
                                        <div class="mibok-time"><?=(GetMessage('LESSONS_NO_FROM').' '.$date1.' '.GetMessage('LESSONS_NO_TO').' '.$date2)?></div>
                                    </div>
                                <?else:?>
                                    <div class="item-lesson"></div>
                                <?endif;?>
                            <?endfor;?>
                         </div>
                    <?else/*if(!isset($arResult['INFO_DAY'][$key+1]) && !isset($arResult['INFO_DAY'][$key-1]))*/:
                        $date1 = date('d.m',$arResult['INFO_DAY'][$key]['tmp']);
                        ?>
                        <div class="item <?=$item['class']?>">
                            <?for($i=0; $i < $arResult['COUNT_LESSONS']; $i++):?>
                                <?if($i % 2 == 0):?>
                                <div class="item-lesson">
                                    <div class=""><?=($arParams['SIGN_NO_DAY'] ? $arParams['SIGN_NO_DAY']  : GetMessage('LESSONS_NO'))?></div>
                                    <div class="mibok-time"><?=$date1?></div>
                                </div>
                                <?else:?>
                                        <div class="item-lesson"></div>
                                <?endif;?>
                            <?endfor;?>
                         </div>
                    <?endif;?>
                <?endif;?>
            <?endforeach;?>
        </div>
        
        <div class="mibok-rasp-copyright"><?=GetMessage('MIBOK_RASP_COPYRIGHT')?></div>
        <?
        if(LANG_CHARSET == 'windows-1251')
        {
            $arParams['SIGN_RECORD'] = mb_convert_encoding($arParams['SIGN_RECORD'], "UTF-8", "Windows-1251");
//            $arParams['SIGN_RECORD_OK'] = mb_convert_encoding($arParams['SIGN_RECORD_OK'], "UTF-8", "Windows-1251");
//            $arParams['SIGN_RECORD_BACK'] = mb_convert_encoding($arParams['SIGN_RECORD_BACK'], "UTF-8", "Windows-1251");
        }
       ?>
        <input type="hidden" name="FIELD_CODE_MODAL" value='<?= json_encode($arParams['FIELD_CODE_MODAL'])?>'>
        <input type="hidden" name="PROPERTY_CODE_MODAL" value='<?=json_encode($arParams['PROPERTY_CODE_MODAL'])?>'>
        <input type="hidden" name="IBLOCK_TYPE" value='<?=$arParams['IBLOCK_TYPE']?>'>
        <input type="hidden" name="IBLOCK_ID" value='<?=$arParams['IBLOCK_ID']?>'>
        <input type="hidden" name="LIST_SETTINGS_MODAL_NAME" value='<?=$arParams['LIST_SETTINGS_MODAL_NAME']?>'>
        <input type="hidden" name="MODAL_DATA" value='<?=json_encode($arParams['MODAL_DATA'])?>'>
        <input type="hidden" name="PROPERTY_CODES_RECORD" value='<?=json_encode($arParams['PROPERTY_CODES_RECORD'])?>'>
        <input type="hidden" name="PROPERTY_CODES_RECORD_REQUIRED" value='<?=json_encode($arParams['PROPERTY_CODES_RECORD_REQUIRED'])?>'>
        <input type="hidden" name="RECORD_PARAM" value='<?=json_encode(array($arParams['IBLOCK_TYPE_RECORD'], $arParams['IBLOCK_ID_RECORD'], $arParams['EVENT_MESSAGE_ID']))?>'> 
        <input type="hidden" name="TIMETABLE_AJAX" value='/bitrix/components/mibok/rasp.timetable.list/ajax.php'>
        <input type="hidden" name="IS_RECORD" value='<?=$arResult['OPTIONS']['rec_timetable']?>'>
        <input type="hidden" name="SIGN" value='<?=json_encode(array('SIGN_RECORD' => $arParams['SIGN_RECORD']/*, 'SIGN_RECORD_OK' => $arParams['SIGN_RECORD_OK'], 'SIGN_RECORD_BACK' => $arParams['SIGN_RECORD_BACK']*/))?>'>
        <input type="hidden" name="CONSENT" value='<?=json_encode(array('USER_CONSENT' => $arParams['USER_CONSENT'], 'USER_CONSENT_ID' => $arParams['USER_CONSENT_ID'],'USER_CONSENT_IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'], 'USER_CONSENT_IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED']))?>'>
    </div>

    <div class="modal fade mibok-modal" id="mibok-timetableModal" tabindex="-1" role="dialog" aria-labelledby="mibok-timetableModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    <div class="mibok-border-bottom"></div>

<?else:?>
    <br>
    <p class="bg-warning bg-label"><b><?=($arParams['SIGN_FILTER'] ? $arParams['SIGN_FILTER'] : GetMessage('TIMETABLE_NOT_LESSON'));?></b></p>
<?endif;?>

