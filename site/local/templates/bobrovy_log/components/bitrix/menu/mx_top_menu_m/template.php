<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="menu">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
			
			<a href="<?=$arItem["LINK"]?>" >
				<?if($arItem["PARAMS"]["icon"] != ''):?>
					<span class="icon_span" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
				<?endif?>
				<?=$arItem["TEXT"]?>
				<span class="open_span fa-minus"></span>
			</a>
			<ul>

	<?else:?>
		
		<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" >
			<?if($arItem["PARAMS"]["icon"] != ''):?>
				<span class="icon_span" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/menu_icons/<?=$arItem["PARAMS"]["icon"]?>.svg);"></span>
			<?endif?>
			<?=$arItem["TEXT"]?></a></li>
		
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>