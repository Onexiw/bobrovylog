<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="menu-sitemap-tree">
<ul>
<?
$previousLevel = 0;
foreach($arResult as $arItem):
?>
<?if($arItem["TEXT"] != "Текущие тендеры"):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
			<li<?if($arItem["CHILD_SELECTED"] !== true && $arItem["DEPTH_LEVEL"] != 1):?> class="menu-close"<?endif?>>
				<div class="item-text" <?=$arItem["DEPTH_LEVEL"] == 1 ? 'style="display:none"' : ''?>><a href="<?=$arItem["LINK"]?>" <?=$arItem["SELECTED"] == 1 ? 'class="mx_selected"' : ''?>><?=$arItem["TEXT"]?></a></div>
				<div class="folder" <?=$arItem["DEPTH_LEVEL"] == 1 ? 'style="display:none"' : ''?> onClick="OpenMenuNode(this)"></div>
				<ul>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				<li>
				<?//d($arItem["SELECTED"])?>
					<div class="item-text"><a href="<?=$arItem["LINK"]?>" <?=$arItem["SELECTED"] == 1 ? 'class="mx_selected"' : ''?>><?=$arItem["TEXT"]?></a></div>
				</li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endif?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
</div>
<?endif?>