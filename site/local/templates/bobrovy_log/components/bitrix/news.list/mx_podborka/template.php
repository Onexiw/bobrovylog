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

<?//d($arResult)?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem["SET"])?>
<div class="col-xs-12">
	<div class="main_service__first">
		<div class="main_service__first__pretitle">Услуги</div>
		<div class="main_service__first__title"><?=$arItem["NAME"]?></div>
		<a href="/services/" class="main_service__first__link">Все услуги</a>
	</div>
</div>
	<?foreach($arItem["SET"] as $arSet):?>
		<div class="col-xs-12">
			<div class="main_service_regular">
				<a href="<?=$arSet["DETAIL_PAGE_URL"]?>" class="main_service__pict">
					<img src="<?=SITE_TEMPLATE_PATH?>/images/loading-512.gif" data-src="<?=$arSet["DETAIL_PICTURE"]?>" class="lazyload main_service__pict__img">
					<span class="main_service__pict__top"></span>
					<span class="main_service__pict__arrow_blue"></span>
					<span class="main_service__pict__arrow"></span>
					<span class="main_service__pict__bottom"></span>
				</a>
				
				<div class="row">
					<div class="col-xs-12 col-md-10 col-md-offset-1">
	
						<div class="main_service__title"><?=$arSet["NAME"]?></div>
						<div class="main_service__text"><?=$arSet["PREVIEW_TEXT"]?></div>
						<div class="main_service__work">
							<div class="row">
								<div class="main_service__work__text col-xs-12 col-sm-12 col-md-8 col-lg-6">
									<?if($arSet["WORK_TIME"] != ""):?>
										<div class="main_service__work__text__title">&#9654; Время работы</div>
										<div class="main_service__work__text__description"><?=$arSet["WORK_TIME"]?></div>
									<?endif?>
									<div class="main_service__work__text__description"><?=$arSet["ADDITIONAL"]?></div>
		
								</div>
							
								<?if($arSet["Mon"]["FROM"] !="" || 
										$arSet["Tue"]["FROM"] !="" || 
										$arSet["Wed"]["FROM"] !="" || 
										$arSet["Thu"]["FROM"] !="" || 
										$arSet["Fri"]["FROM"] !="" || 
										$arSet["Sat"]["FROM"] !="" || 
										$arSet["Sun"]["FROM"] !=""
									):?>
									<div class="main_service__work__status col-xs-12 col-sm-12 col-md-4 col-lg-6">
										<div class="main_service__work__status__title">&#9654; Статус</div>
										
										<?
										$day_of_a_week = date("D");
										$time_now = (int)date("H");
																						
										if($arSet[$day_of_a_week]["FROM"] <= $time_now && $arSet[$day_of_a_week]["TO"] > $time_now) {
											$opened = 'Открыто';
											$openedClass = 'opened';
										} else {
											$opened =  'Закрыто';
											$openedClass = 'closed';
										}
										?>
										
										<div class="main_service__work__status__value <?=$openedClass?>"><?=$opened?></div>
									</div>
								<?endif?>
							</div>
						</div>
					
					</div>
				</div>

			</div>
		</div>
	<?endforeach?>
<?endforeach;?>