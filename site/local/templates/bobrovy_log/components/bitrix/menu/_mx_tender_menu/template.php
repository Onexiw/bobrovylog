<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="mobile-multilevel-menu" class="hidden-xs"  >
<?//d($arResult)?>
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

<?if($arItem["TEXT"] != "Текущие тендеры"):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?if ($arItem["SELECTED"]):?>opened<?else:?>closed<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a><arrow class="menu_closed"></arrow><arrow class="menu_opened"></arrow>
				<ul>
		<?else:?>
			
			<li<?if ($arItem["SELECTED"]):?> class="item-selected closed"<?else:?> class="closed"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent closed"><?=$arItem["TEXT"]?></a>
			<arrow class="menu_closed"></arrow><arrow class="menu_opened"></arrow>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="closed"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected closed"<?else:?> class="closed"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>


	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endif?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>