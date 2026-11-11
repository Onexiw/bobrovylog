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

<?
//p($arParams);
?>

<div class="rasp_header">
	<div class="rasp_header__date">

		<?$day=(int)date("d");?>
		<?$month=date("m");?>
		
		<?if(LANGUAGE_ID != "en"):?>
			<?$m = Array(
				"01" => 'января',
				"02" => 'февраля',
				"03" => 'марта',
				"04" => 'апреля',
				"05" => 'мая',
				"06" => 'июня',
				"07" => 'июля',
				"08" => 'августа',
				"09" => 'сентября',
				"10" => 'октября',
				"11" => 'ноября',
				"12" => 'декабря',
			);
			?>
		<?else:?>
			<?$m = Array(
				"01" => 'january',
				"02" => 'february',
				"03" => 'march',
				"04" => 'april',
				"05" => 'may',
				"06" => 'june',
				"07" => 'july',
				"08" => 'august',
				"09" => 'september',
				"10" => 'october',
				"11" => 'november',
				"12" => 'december',
			);
			?>
		<?endif?>		


		<div class="rasp_header__date__period"></div><div class="rasp_header__date__current"><?=GetMessage("today")?> <span><?=LANGUAGE_ID != "en" ? $day.' '.$m[$month] : $m[$month].' '.$day?></span></div>
		
		
		<div class="raspisanie_prev">
			<svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path class="raspisanie__circle" d="M15.5 30.5C7.17614 30.5 0.5 23.8239 0.5 15.5C0.5 7.17614 7.17614 0.5 15.5 0.5C23.8239 0.5 30.5 7.17614 30.5 15.5C30.5 23.8239 23.8239 30.5 15.5 30.5Z" fill="white" stroke="#E0E0E0" stroke-miterlimit="10"/>
				<path class="raspisanie__arr" d="M21 15.0996H8" stroke="#005481" stroke-width="2" stroke-miterlimit="10"/>
				<path class="raspisanie__arr" d="M14.1382 7.71917L22.164 15.1978L14.1275 22.595L13.5061 21.9258L20.3404 15.566L20.7338 15.2L20.3404 14.834L13.4937 8.46275L14.1382 7.71917Z" fill="#005481" stroke="#005481"/>
			</svg>
		</div>
		<div class="raspisanie_next">
			<svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path class="raspisanie__circle" d="M15.5 30.5C7.17614 30.5 0.5 23.8239 0.5 15.5C0.5 7.17614 7.17614 0.5 15.5 0.5C23.8239 0.5 30.5 7.17614 30.5 15.5C30.5 23.8239 23.8239 30.5 15.5 30.5Z" fill="white" stroke="#E0E0E0" stroke-miterlimit="10"/>
				<path class="raspisanie__arr" d="M21 15.0996H8" stroke="#005481" stroke-width="2" stroke-miterlimit="10"/>
				<path class="raspisanie__arr" d="M14.1382 7.71917L22.164 15.1978L14.1275 22.595L13.5061 21.9258L20.3404 15.566L20.7338 15.2L20.3404 14.834L13.4937 8.46275L14.1382 7.71917Z" fill="#005481" stroke="#005481"/>
			</svg>
		</div>

	</div>
		
</div>
<?//d($arResult)?>
<?$arPeriodNo = $arResult['PERIOD_DAY_NO'];?>
<?if(count($arResult['ITEMS']) > 0):?>
    <div class="mibok-wrapper-grid mibok-preloader">
	    <div class="rasp_title">
				<?foreach($arResult["SECTIONS"] as $o => $arObject):?>	
					<div class="rasp_title__item">
						<?=LANGUAGE_ID == "en" ? $arResult["SECTIONS_ENG"][$o] : $arObject?>
					</div>
				<?endforeach?>  		
	    </div>
	    
        <div class="mibok-grid-bg">
            <div class="owl-carousel owl-theme mibok-carousel-day">
                    <?$keyNext = -1;
                    foreach($arResult['PERIOD_DAY_NO'] as $key => $item):

                        $nextDay = next($arResult['PERIOD_DAY_NO']);
                        if($keyNext == $key)
                            continue;
		                    $date = date('j',$item['tmp']);
		                    if(LANGUAGE_ID != "en") {
			                    $month = MibokRasp::ruDateFull("M", $item['tmp']);
			                    $day = MibokRasp::ruDateFull("D", $item['tmp']);
			                  } else {
			                    $month = MibokRasp::enDateFull("M", $item['tmp']);
			                    $day = MibokRasp::enDateFull("D", $item['tmp']);
			                  }
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
						                    if(LANGUAGE_ID != "en") {
	                                $month2 = MibokRasp::ruDateFull("M", $nextDay['tmp']);
	                              } else {
	                                $month2 = MibokRasp::enDateFull("M", $nextDay['tmp']);
	                              }
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
                                    <div class="item-lesson <?=$arLesson['PROPERTY_COLOR']?>" data-class-color=" <?=$arLesson['PROPERTY_COLOR']?>" data-id="<?=$arLesson['ID']?>" data-tmstmp="<?=$item['tmp']?>" mx_date="<?=date('d.m.Y', $item['tmp']);?>" mx_name="<?=str_replace(' ', '', $arResult["SECTIONS_ID_CLEAR"][$arLesson["ID"]])?>">
	                                    	<div class="item-lesson__date">
		                                    	<?$date = date('j',$item['tmp']);
                    		                    if(LANGUAGE_ID != "en") {
													                    $month = MibokRasp::ruDateFull("M", $item['tmp']);
																							$day = MibokRasp::ruDateFull("D", $item['tmp']);
													                    
													                    $d = Array(
																								"Sun" => 'воскресенье',
																								"Mon" => 'понедельник',
																								"Tue" => 'вторник',
																								"Wed" => 'среда',
																								"Thu" => 'четверг',
																								"Fri" => 'пятница',
																								"Sat" => 'суббота'
																								);
																							
																						} else {
													                    $month = MibokRasp::enDateFull("M", $item['tmp']);
																							$day = MibokRasp::enDateFull("D", $item['tmp']);
													                    
													                    $d = Array(
																								"Sun" => 'sunday',
																								"Mon" => 'monday',
																								"Tue" => 'tuesday',
																								"Wed" => 'wednesday',
																								"Thu" => 'thursday',
																								"Fri" => 'friday',
																								"Sat" => 'saturday'
																								);
																							
																						}
												                    //$day = date("D", $item['tmp']);?>
												                    
		                                    	<?=$date?> <?=$month?>, <?//=$d[$day]?><?=$day?>
	                                    	</div>
                                        <div class="mibok-time">
											<?if($arLesson['BEGIN'] != '00.00' && $arLesson['END']  != '00.00'):?>
											
												
											<?if($arResult["ITEMS"][$arLesson["ID"]]["PROPERTIES"]["NOWORK"]["VALUE"] == 'Y'):?>
	                                        <div class="lesson-time-info"><?=GetMessage("not_work")?></div>
                                        <?else:?>
												<span class='lesson-time-info'><?=$arLesson['BEGIN']?> - <?=$arLesson['END'] == "23.59" ? "00:00" : $arLesson['END']?></span>
												<?endif?>
												
											<?endif;?>
                                            <?if($arLesson['IBLOCK_LIMIT'] > 0 && $item['class'] != 'day-past'/*&& isset($arResult['OPTIONS']['rec_timetable']) && $arResult['OPTIONS']['rec_timetable'] =='Y'*/):?>
                                                <span data-rasp-id="<?=$arLesson['ID']?>_<?=$item['tmp']?>" class='count-rasp <?if($arLesson['IBLOCK_LIMIT'] == $arLesson['TABLE_LIMIT']):?>no-item-record<?endif;?>'>
                                                    <?=$arLesson['TABLE_LIMIT']?>/<?=$arLesson['IBLOCK_LIMIT']?>
                                                </span>
                                            <?elseif($arLesson['IBLOCK_LIMIT'] == '-1' && $item['class'] != 'day-past'):?>
                                                <span class='stop-record no-item-record'></span>
                                            <?endif;?>
                                        </div>
                                        
                                        
	                                        <div class="lesson__name"><?=$arResult["SECTIONS_ID_CLEAR"][$arLesson["ID"]]?></div>
                                        
                                        <?//d($arLesson)?>
                                        
                                        <?//=$arResult["ITEMS"][$arLesson["ID"]]["PROPERTIES"]["BUTTON"]["VALUE"]?>
                                        
                                       
                                        
<!--
                                        <?if($arResult["ITEMS"][$arLesson["ID"]]["PROPERTIES"]["BUTTON"]["VALUE"] != ''):?>
																					<a class="item-lesson__modal" data-toggle="modal" data-target="#lesson_modal" descr="<?=$arResult["ITEMS"][$arLesson["ID"]]["PROPERTIES"]["DESCR"]["~VALUE"]["TEXT"]?>"><?=$arResult["ITEMS"][$arLesson["ID"]]["PROPERTIES"]["BUTTON"]["VALUE"]?></a>
																				<?endif?>
-->

                                        
                                        
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

<script>
	$('.item-lesson__modal').on('click', function(e){
		var title = $(this).text();
		var descr = $(this).attr('descr');
		$('#lesson_modal .modal-title').html(title);
		$('#lesson_modal .modal-body').html(descr);
	}); 
</script>

<!-- Modal -->
<div class="modal fade" id="lesson_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
