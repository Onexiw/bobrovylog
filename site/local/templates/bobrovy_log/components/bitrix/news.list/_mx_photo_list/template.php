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
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem["DETAIL_PICTURE"])?>
		
		<?if($arItem["PROPERTIES"]["BIG"]["VALUE"] != "Y"):?>
			<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
				<div class="news__item">
					
					<?if($arItem["DETAIL_PICTURE"]["ID"] != ""):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__picture">
							<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
							<img src="<?=$file["src"]?>">
							<div class="news__item__picture__gradient"></div>
						</a>
					<?endif?>
					
					<div class="news__item__block">
						<div class="news__item__block__date">
						
							<?if($arItem["PROPERTIES"]["DATE"]["VALUE"] != ""):?>
								
								<?$day=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
								<?$month=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
								<?$year=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>
		
							<?else:?>
							
								<?$day=substr($arItem["DATE_CREATE"], 0, 2)?>
								<?$month=substr($arItem["DATE_CREATE"], 3, 2)?>
								<?$year=substr($arItem["DATE_CREATE"], 6, 4)?>
								
							<?endif?>
		
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
							
							
							🗓 <?echo $day.' '.$m[$month].' '.$year?>
						</div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__block__title"><?=$arItem["NAME"]?></a>
						<div class="news__item__block__text">
							<?echo strip_tags($arItem["DETAIL_TEXT"]);?>
						</div>
						<div class="news__item__block__shadow"></div>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__link"><span>Читать больше &#10132;</span></a>
				</div>
				<div class="clear"></div>
			</div>
		<?else:?>
			<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
				<div class="news__item_big">
					<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="lazyload news__item_big__picture" data-src="<?=$file["src"]?>">
						<div class="news__item_big__picture__gradient"></div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="news__item_big__blank">
						<div class="news__item_big_wrapper">
							<div class="news__item_big__block">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_big__block__title"><?=$arItem["NAME"]?></a>
							</div>
							
							<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ''):?>
								<div class="news__item_big__block__photograph">📷 <?=$arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
							<?endif?>
						
							<?if($arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
								<div class="news__item_big__block__author">❄️ <?=$arResult["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
							<?endif?>
						</div>
						<div class="news__item_big__arrow">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</div>
					</a>
				</div>
				<div class="clear"></div>
			</div>
		<?endif?>

<?endforeach;?>
