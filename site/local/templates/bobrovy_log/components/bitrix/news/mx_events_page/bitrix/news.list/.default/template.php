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

<?//d($arResult["ORDER"])?>
<?$mw = array(
		'01' => 'ЯНВАРЬ',
		'02' => 'ФЕВРАЛЬ',
		'03' => 'МАРТ',
		'04' => 'АПРЕЛь',
		'05' => 'МАЙ',
		'06' => 'ИЮНЬ',
		'07' => 'ИЮЛЬ',
		'08' => 'АВГУСТ',
		'09' => 'СЕНТЯБРЬ',
		'10' => 'ОКТЯБРЬ',
		'11' => 'НОЯБРЬ',
		'12' => 'ДЕКАБРЬ',
	);
?>
<div class="event__list">
	<?foreach($arResult["ORDER"] as $y => $arYear):?>
		<?//d($y)?>
		<?foreach($arResult["ORDER"][$y] as $m => $arMonth):?>
			<?//d($m)?>
			<div class="row event__list__row">
				<div class="event__date">
					<div class="col-xs-12">
						<div class="event__date__border"></div>
						<div class="event__date__month"><?=$mw[$m];?> <?=$y?></div>
					</div>
					
					<div class="col-xs-12">
						<div class="row">
							<?foreach($arResult["ORDER"][$y][$m] as $arItem):?>
								<?//if():?>
								<?//d($arItem)?>
								<div class="col-xs-6 col-md-4 event__item">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="event__item__link">
										<div class="event__item__date">
											<div class="event__item__date__value"><?=$arItem["DATE"]?></div>
											<div class="event__item__date__month"><?=$arItem["MONTH"]?></div>
											<div class="clear"></div>
										</div>
										
										<div class="event__item__cutblock">
											<div class="event__item__title"><?=$arItem["NAME"]?></div>
											<div class="event__item__text"><?=$arItem["~PREVIEW_TEXT"]?></div>
										</div>
										<div class="event__item__more">Читать больше &#10132;</div>
									</a>
								</div>
							<?endforeach?>
						</div>
					</div>	
					<div class="clear"></div>				
				</div>
			</div>
		<?endforeach?>
	<?endforeach?>
	<?//d($arItem)?>
</div>
