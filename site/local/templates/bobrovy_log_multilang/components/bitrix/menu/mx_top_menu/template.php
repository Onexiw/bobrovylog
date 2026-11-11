<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="menu">

<?
//d($arResult);
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<li class="parent <?if ($arItem["SELECTED"]):?>active<?endif?>">
			
			<?if($arItem["DEPTH_LEVEL"] != 1):?>
				<div class="lvl_2_title">
			<?else:?>
				<a href="<?=$arItem["LINK"]?>">
			<?endif?>
				<?if($arItem["PARAMS"]["icon"] != ''):?>
					<span class="icon_span" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
				<?endif?>
				

				<?if($arItem["CHAIN"][0] != ""):?>
					<?if(LANGUAGE_ID == 'en'){
						if($arItem["PARAMS"]["DESCR"] != "") {
							echo $arItem["PARAMS"]["DESCR"];
						} else {
							echo $arItem["CHAIN"][0];
						}
					} else {
						echo $arItem["TEXT"];
					}?>
				<?else:?>
					<?= $arItem["TEXT"]?>
				<?endif?>
				
			<?if($arItem["DEPTH_LEVEL"] != 1):?>
				</div>
			<?else:?>
				</a>
			<?endif?>
		<ul>

	<?else:?>
		
			<li class="<?if ($arItem["SELECTED"]):?>active <?elseif (isset($arItem["PARAMS"]["class"])):?>taigaclass<?endif?> ">
			<a href="<?=$arItem["LINK"]?>" >
				<?if($arItem["PARAMS"]["icon"] != ''):?>
					<span class="icon_span" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
				<?endif?>
				<?if($arItem["ADDITIONAL_LINKS"]["DESCR"] != ""):?>
					<?=LANGUAGE_ID == 'en' ? $arItem["ADDITIONAL_LINKS"]["DESCR"] : $arItem["TEXT"]?>
				<?else:?>
					<?= $arItem["TEXT"]?>
				<?endif?>
			</a>
		</li>
		
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>