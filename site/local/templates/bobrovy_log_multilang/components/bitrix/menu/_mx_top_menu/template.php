<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="menu">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li>
			<a href="<?=$arItem["LINK"]?>" class="selected">
				<span style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
				<?=$arItem["TEXT"]?>
			</a>
		</li>
	<?else:?>
		<li>
			<a href="<?=$arItem["LINK"]?>">
				<span style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
				<?=$arItem["TEXT"]?>
			</a>
		</li>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif?>