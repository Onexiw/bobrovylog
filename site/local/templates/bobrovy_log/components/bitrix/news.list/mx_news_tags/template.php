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
<div class="tag_list">
	<?if($_REQUEST["tag"] == 'Фотогалерея'):?>
		<?$active = 'active';?>
	<?else:?>
		<?$active = '';?>
	<?endif?>
	<a href="/news/?tag=Фотогалерея" tag="Фотогалерея" class="tag_list__element <?=$active?>">Фотогалерея</a>

	<?foreach($arResult["NEWS_TAGS"] as $arTag):?>
		<?if($_REQUEST["tag"] == $arTag):?>
			<?$active = 'active';?>
		<?else:?>
			<?$active = '';?>
		<?endif?>
		<a href="/news/?tag=<?=$arTag?>" tag="<?=$arTag?>" class="tag_list__element <?=$active?>"><?=$arTag?></a>
	<?endforeach;?>
</div>
