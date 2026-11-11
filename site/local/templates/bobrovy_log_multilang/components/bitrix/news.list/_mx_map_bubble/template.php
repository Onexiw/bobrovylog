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

<?foreach($arResult["ITEMS"] as $arItem):?>

	<?
	switch ($arItem["PROPERTIES"]["BUBBLE_SIDE"]["VALUE"]) {
    case 'Вверх':
        $side = "up";
        break;
    case 'Вправо':
        $side = "right";
        break;
    case 'Вниз':
        $side = "down";
        break;
    case 'Влево':
        $side = "left";
        break;
    default:
        $side = "right";
		}
		?>

	<div class="map_bubble <?=$side?>" cls="<?=$arItem["PROPERTIES"]["CLASS"]["VALUE"]?>" side="<?=$side?>">
		<div class="map_bubble__block">
			<div class="map_bubble__title"><?=$arItem["NAME"]?></div>
			<div class="map_bubble__list">
				<?foreach($arItem["SERVICE"] as $k=>$arService):?>
					<div class="map_bubble__list__item">
						<div class="map_bubble__list__item__icon">
							<img data-src="<?=$arService["ICON"]?>" class="lazyload map_bubble__list__item__icon__img">
						</div>
						<div class="map_bubble__list__item__text"><?=$arService["DETAIL_TEXT"]?></div>
					</div>
				<?endforeach?>
			</div>
		</div>
	</div>
<?endforeach?>
