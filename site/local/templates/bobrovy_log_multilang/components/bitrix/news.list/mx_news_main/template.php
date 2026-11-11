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
<?$i=0?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="news_main__pair__item count_<?=$i?>">
		<div class="news_main__pair__item__gray"></div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="lazyload news_main__pair__item__picture" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/square.png)" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
			<img data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" class="lazyload news_main__pair__item__picture__img">
			<div class="news_main__pair__item__picture__gradient"></div>
		</a>
		<div class="news_main__pair__item__info">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_main__pair__item__info__title"><?=$arItem["NAME"]?></a>
			<div class="news_main__pair__item__info__text">
			
				<?echo strip_tags($arItem["DETAIL_TEXT"]);?>
			
			</div>
		</div>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_main__pair__item__link"><span>Читать больше &#10132;</span></a>
	</div>
	<?$i++?>
<?endforeach;?>
