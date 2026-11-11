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
	<div class="rules_list" id="rules_list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		
		<div class="rules__item">
			<a class="rules__item__label collapsed" role="button" data-toggle="collapse" data-parent="#rules_list" href="#t_<?=$arItem["ID"]?>" aria-expanded="false" aria-controls="t_<?=$arItem["ID"]?>"><span><?=$arItem["NAME"]?></span></a>
			<div class="rules__item__block collapse" id="t_<?=$arItem["ID"]?>"><?=$arItem["~DETAIL_TEXT"]?></div>			
		</div>
			
	<?endforeach;?>
	</div>
</div>
