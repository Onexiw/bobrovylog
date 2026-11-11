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

<div class="row">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem)?>
  <div class="also__item col-xs-12 col-sm-6">
	  <div class="row">
	  	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="also__item__picture col-xs-12 col-sm-6">
				<img class="lazyload also__item__picture__img" src="<?=SITE_TEMPLATE_PATH?>/images/loading.gif" data-src="<?=$arItem["DISPLAY_PROPERTIES"]["ROUND_PICT"]["FILE_VALUE"]["SRC"]?>"/>
	  	</a>  
	  	<div class="also__item__info col-xs-12 col-sm-6">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="also__item__info__title"><?=LANGUAGE_ID == "en" ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"]?></a>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="also__item__info__more"><?=GetMessage("know_more")?> &#10132;</a>
			</div>
	  </div>  
  </div>

<?endforeach;?>
</div>