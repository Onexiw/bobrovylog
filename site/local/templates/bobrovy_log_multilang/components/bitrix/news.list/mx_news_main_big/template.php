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
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="lazyload news_big__item" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/square.png)" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
		<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_530.png" class="news_main__big__spacer">
		<div class="news_big__item__gradient"></div>
		
		<div class="news_big__item__abs">
			<div class="news_big__item__abs__bottom">
				<div class="news_big__item__abs__bottom__title"><?=$arItem["NAME"]?></div>
				
				<?if($arItem["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ""):?>
					<div class="news_big__item__abs__bottom__photograph">📷 <?=$arItem["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
				<?endif?>
				
				<?if($arItem["PROPERTIES"]["AUTHOR"]["VALUE"] != ""):?>
					<div class="news_big__item__abs__bottom__author">❄️ <?=$arItem["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
				<?else:?>
					<br/>
				<?endif?>
			</div>
		</div>
		<div class="news_big__item__arrow">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>
	</a>
<?endforeach;?>
