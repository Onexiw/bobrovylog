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

<?if($APPLICATION->GetCurPage(true) == '/tenders-ended/index.php'):?>
	<?$hide = 'mobile_hidden_tender_news';?>
<?else:?>
	<?$hide = '';?>
<?endif?>
<div class="col-xs-12 col-md-8 <?=$hide?>">
	<div class="konkursi_list" id="konkursi_list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		
		<div class="konkursi__item">
			<b><?=$arItem["PROPERTIES"]["FULL_NAME"]["~VALUE"]["TEXT"]?></b>
			<div class="clear"></div>
			
			<div class="clear"></div>	
			<?if($arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]["TEXT"] != ""):?>
				<br>
				<?=$arItem["PROPERTIES"]["FIRST_TEXT"]["~VALUE"]["TEXT"]?>
			<?endif?>
			
			<?if($arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"] != ''):?>
		
					<?if(!is_array($arItem["DISPLAY_PROPERTIES"]["FILES"]["DISPLAY_VALUE"])):?>
							<?$ext = explode('.', $arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["SRC"]);?>
							<a href="<?=$arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]["SRC"]?>" target="_blank" class="konkursi__item__file"><?=$arItem["DISPLAY_PROPERTIES"]["FILES"]["DESCRIPTION"][0]?>.<?=$ext[1]?></a>
					<?else:?>
						<?foreach($arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"] as $f => $arFile):?>
							<?$ext = explode('.', $arFile["SRC"]);?>
							<a href="<?=$arFile["SRC"]?>" target="_blank" class="konkursi__item__file"><?=$arFile["DESCRIPTION"]?>.<?=$ext[1]?></a>
						<?endforeach?>
					<?endif?>
			<?endif?>
			
			
			<?if($arItem["PROPERTIES"]["CONTACT"]["~VALUE"]["TEXT"] != ""):?>
				<div class="clear"></div>	
				<br>
				<b>Контактные данные:</b><br>
				<div class="konkursi__item__contact">
				<?=$arItem["PROPERTIES"]["CONTACT"]["~VALUE"]["TEXT"]?>
				</div>
			<?endif?>

			<div class="clear"></div>	
			<?if($arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]["TEXT"] != ""):?>
				<br>
				<?=$arItem["PROPERTIES"]["LAST_TEXT"]["~VALUE"]["TEXT"]?>
			<?endif?>
		</div>
			
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

	</div>
</div>
