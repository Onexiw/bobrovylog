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
<?//d($arResult)?>
<div class="col-xs-12 col-md-8">
	<div class="vakancy_list" id="vakancy_list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="vakancy__item">
			<div class="vakancy__item_block">
				<div class="vakancy__item__title">ВАКАНСИЯ</div>
				<div class="vakancy__item__name"><b><?=$arItem["NAME"]?></b></div>
			</div>		
			
			<div class="vakancy__item_block">
				<div class="vakancy__item__title">ТРЕБОВАНИЯ К КАНДИДАТАМ</div>
				<div class="vakancy__item__name"><?=(is_array($arItem["PROPERTIES"]["REQIUREMENTS"]["~VALUE"]) ? $arItem["PROPERTIES"]["REQIUREMENTS"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["REQIUREMENTS"]["~VALUE"])?></div>
			</div>
			
			<div class="vakancy__item_block">
				<div class="vakancy__item__title">Условия работы</div>
				<div class="vakancy__item__name"><?=(is_array($arItem["PROPERTIES"]["CONDITIONS"]["~VALUE"]) ? $arItem["PROPERTIES"]["CONDITIONS"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["CONDITIONS"]["~VALUE"])?></div>
			</div>	
			
			<a href="mailto:<?=$arResult["~DESCRIPTION"]?>" class="vakancy__item__link">Отправить резюме</a>
		</div>
			
	<?endforeach;?>
	</div>
</div>