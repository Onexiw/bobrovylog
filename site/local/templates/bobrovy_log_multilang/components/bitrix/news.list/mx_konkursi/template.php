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
			<?=(is_array($arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"]) ? $arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"])?>
			<div class="clear"></div>
			<?if($arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"][0]):?>
			<?foreach($arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"] as $f => $arFile):?>
				<?$ext = explode('.', $arFile["SRC"]);?>
				<a href="<?=$arFile["SRC"]?>" target="_blank"><?=$arFile["DESCRIPTION"]?>.<?=$ext[1]?></a>
			<?endforeach?>
			<?else:?>
				<?$ext = explode('.', $arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["SRC"]);?>
				<a href="<?=$arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["SRC"]?>" target="_blank"><?=$arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["DESCRIPTION"]?>.<?=$ext[1]?></a>
			<?endif?>
				
			<div class="clear"></div>	
			<?if($arItem["~DETAIL_TEXT"] != ""):?>
				<br>
				<?=$arItem["~DETAIL_TEXT"]?>
			<?endif?>
		</div>
			
	<?endforeach;?>
	</div>
</div>