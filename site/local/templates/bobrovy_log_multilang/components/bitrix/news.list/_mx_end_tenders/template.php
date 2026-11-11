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
<div class="col-xs-12 col-md-8">
	<div class="konkursi_list" id="konkursi_list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		
		<div class="konkursi__item">
			<b><?=(is_array($arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"]) ? $arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"])?></b>
			<div class="clear"></div>
			
			<div class="clear"></div>	
			<?if((is_array($arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]) != ""):?>
				<br>
				<?=(is_array($arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"])?>
			<?endif?>

			<?foreach($arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"] as $f => $arFile):?>
				<?$ext = explode('.', $arFile["SRC"]);?>
				<a href="<?=$arFile["SRC"]?>" target="_blank"><?=$arFile["DESCRIPTION"]?>.<?=$ext[1]?></a>
			<?endforeach?>
				
			<?if((is_array($arItem["PROPERTIES"]["CONTACT"]["~VALUE"]) ? $arItem["PROPERTIES"]["CONTACT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["CONTACT"]["~VALUE"]) != ""):?>
				<div class="clear"></div>	
				<br>
				<b>Контактные данные:</b><br>
				<div class="konkursi__item__contact">
				<?=(is_array($arItem["PROPERTIES"]["CONTACT"]["~VALUE"]) ? $arItem["PROPERTIES"]["CONTACT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["CONTACT"]["~VALUE"])?>
				</div>
			<?endif?>

			<div class="clear"></div>	
			<?if((is_array($arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]) != ""):?>
				<br>
				<?=(is_array($arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"])?>
			<?endif?>
		</div>
			
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

	</div>
</div>


	