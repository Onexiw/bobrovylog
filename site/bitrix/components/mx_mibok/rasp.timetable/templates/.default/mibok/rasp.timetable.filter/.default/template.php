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


<div class='mibok-word-all'><?=GetMessage('DEFAULT_ALL')?></div>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="post">
	<div class="mibok-wrapper-timetable">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mibok-wrapper-filter">
                    <div class="mibok-filter-left pull-left">
                        <h2><?=($arParams['SIGN_HEAD'] ? $arParams['SIGN_HEAD'] : GetMessage('TIMETABLE_H1'))?></h2>
                        <?if(!empty($arResult['FILTER_HEADER'])):?>
                            <?foreach($arResult['FILTER_HEADER'] as $key => $arValue):
                                ?>
                                <?if(!empty($arValue['VALUE_LIST'])):?>
                                    <div class="mibok-dropdown">
                                        <a href="#" class="mibok-filter-list-head dropdown-toggle"  data-toggle="dropdown"><?=$arValue['NAME_BLOCK']//GetMessage('DEFAULT_ALL')?> <span class="ic-m-t-bottom"></span></a>
                                        <div class="dropdown-menu">
                                            <ul class="scroll-visible">
                                                <?
                                                foreach($arValue['VALUE_LIST'] as $keyV => $value):
                                                    ?>
                                                    <li>
                                                        <div>
                                                            <input type="checkbox" class="checkbox" name="<?=$arValue['NAME_CHECK']?>" id="<?=$arValue['NAME_CHECK'].$keyV?>" value="<?=$arValue['VALUE_CHECK'][$keyV]?>" <?=$arValue['CHECKED'][$keyV]?>/><label for="<?=$arValue['NAME_CHECK'].$keyV?>" title="<?=$value?>"><?=$value?></label>
                                                        </div>
                                                    </li>
                                                <?endforeach;?>
                                            </ul>
                                           <?/*<div><button class="btn btn-mibok"><?=GetMessage('BTN_NAME')?></button></div>*/?>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endforeach?>
                        <?endif;?>
                    </div>
                    <div class="mibok-filter-right pull-right">
                        <?if(!isset($arParams['FILTER_DATE_RANGE']) || $arParams['FILTER_DATE_RANGE'] == 'Y'):
                            $periodBegin = ($arResult['REQUEST']['period_begin'] ? $arResult['REQUEST']['period_begin'] : $arResult['PERIOD'][0]);
                            $periodEnd = ($arResult['REQUEST']['period_end'] ? $arResult['REQUEST']['period_end'] : $arResult['PERIOD'][count($arResult['PERIOD'])-1]);
?>
                            <div class="mibok-span-name-period"><?=GetMessage('PERIOD')?> </div>
							<div class="input-daterange input-group mibok-daterange" id="datepicker">
								<input type="hidden" class="hidden" name="daterange" value="<?=$periodBegin?>,<?=$periodEnd?>" />
								<input type="hidden" class="hidden" name="minDate" value="<?=$arResult['DATEPICKER']['MIN_DATE']?>" />
								<input type="hidden" class="hidden" name="dateLimit" value="<?=$arResult['DATEPICKER']['DATE_LIMIT']?>" />
								<input type="hidden" class="hidden" name="dayList" value="<?=GetMessage('DAY_LIST')?>" />
								<input type="hidden" class="hidden" name="monthList" value="<?=GetMessage('MONTH_LIST')?>" />
								<div class="input-group date">
									<input type="text" class="form-control" name="period_begin"  value="<?=$periodBegin?>" readonly>
									<span class="input-group-addon inpit-span-dif"> - </span>
                                    <input type="text" class="form-control" name="period_end" value="<?=$periodEnd?>" readonly/>
									<span class="input-group-addon"><i class="ic-m-t-calendar"></i></span>
								</div>
							</div>
                        <?else:?>
                        <?=GetMessage('PERIOD')?><span><?=$arResult['PERIOD'][0]?> - <?=$arResult['PERIOD'][count($arResult['PERIOD'])-1]?></span>
                        <?endif;?>
                    </div>

                    <div class="clearfix"></div>
                    <?if(!empty($arResult['FILTER_ALL'])):?>
                        <div class="mibok-slide-filter">
                            <input type="checkbox" class="checkbox" id="filter" value="filter"/><label for="filter" title="<?=GetMessage('VIEW_FILTER')?>"><?=GetMessage('VIEW_FILTER')?></label>
                        </div>
                        <div class="mibok-add-filter row">
                            <?foreach($arResult['FILTER_ALL'] as $key => $arValue):
                                ?>
                                <?if(!empty($arValue['VALUE_LIST'])):?>
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                        <div class="mibok-dropdown">
                                            <div class="mibok-item-filter dropdown-toggle" data-toggle="dropdown">
                                                <div class="mibok-filter-name"><?=$arValue['NAME']?></div>
                                                <div class="mibok-filter-value"><?=$arValue['NAME_BLOCK']?></div>
                                                <div class="mibok-caret"><span class="ic-m-t-bottom"></span></div>
                                            </div>
                                            <div class="dropdown-menu">
                                                <ul class="scroll-visible">
                                                    <?
                                                    foreach($arValue['VALUE_LIST'] as $keyV => $value):
                                                        ?>
                                                        <li>
                                                            <div>
                                                                <input type="checkbox" class="checkbox" name="<?=$arValue['NAME_CHECK']?>" id="<?=$arValue['NAME_CHECK'].$keyV?>" value="<?=$arValue['VALUE_CHECK'][$keyV]?>" <?=$arValue['CHECKED'][$keyV]?>/><label for="<?=$arValue['NAME_CHECK'].$keyV?>" title="<?=$value?>"><?=$value?></label>
                                                            </div>
                                                        </li>
                                                    <?endforeach;?>
                                                </ul>
                                               <?/*<div><button class="btn btn-mibok"><?=GetMessage('BTN_NAME')?></button></div>*/?>
                                            </div>
                                        </div>
                                    </div>
                                <?endif?>
                            <?endforeach;?>
                        </div>
                        <div class="mibok-add-filter1 row mibok-filter-buttons">
                            <div class="col-lg-3 col-lg-offset-6 col-md-4 col-sm-4 col-xs-6 pull-right1">
                                <div><button class="btn btn-mibok" type="submit" name="set_filter"><?=GetMessage('BTN_NAME')?></button></div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 pull-right1">
                                <div><button class="btn btn-mibok btn-default" type="submit" name="del_filter"><?=GetMessage('BTN_NAME_CLEAR')?></button></div>
                            </div>
                        </div>
                    <?endif?>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="hidden">
        <input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
        <input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
        <input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" />
    </div>
</form>


