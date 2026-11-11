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
<div class="service__detail__slider_simple about_detail">
  <div class="lazyload service__detail__slider__item" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">				  
	  <img data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="service__detail__slider__item_blank lazyload">
	  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="service__detail__slider__item_mobile">
	</div>
	
  <div class="service__detail__slider__nav_page">
	  <div class="service__detail__slider__nav_page__title"><?=LANGUAGE_ID == 'en' ? $arResult["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arResult["NAME"]?></div>
	  
	</div>

			<div class="vidget">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/vidget.php"
					)
				);?>
			</div>

</div>


<div class="service__detail_wrapper about_detail">
	<div class="col-xs-12 col-sm-8">		
		<div class="service__detail__title"><h1><?=LANGUAGE_ID == 'en' ? $arResult["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arResult["NAME"]?></h1></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 service__detail_side">
		<div class="service__detail_side_wrapper">

			<div class="service__detail_side__prices">
				<?if((is_array($arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"]) ? $arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"]) != '' || (is_array($arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]) !=""):?>
					<div class="service__detail_side__prices__title">▶ <?=GetMessage("information")?></div>
					<div class="service__detail_side__prices__description">
						<?=LANGUAGE_ID == 'en' ? (is_array($arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SIDEBAR_ENG"]["~VALUE"]) : (is_array($arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"]) ? $arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SIDEBAR"]["~VALUE"])?>
					</div>
				<?endif?>
			</div>
													
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-8 service__detail_part">
	
		<div class="service__detail__text">
			<?=LANGUAGE_ID == 'en' ? (is_array($arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) : $arResult["~DETAIL_TEXT"]?>		
		</div>
		<div class="clear"></div>
	</div>
	<div class="col-xs-12 col-sm-4">
		
	</div>
	<div class="clear"></div>

</div>