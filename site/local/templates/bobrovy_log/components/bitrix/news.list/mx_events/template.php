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

<div class="swiper-container event_slider">

  <div class="swiper-wrapper">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		  <div class="swiper-slide">
				<div class="col-xs-12">
					<div class="event_slider__item">
						<div class="row">
							<div class="col-xs-12 col-sm-5 col-md-4">
								<?//d($arItem)?>
								<div class="event_slider__item__date"><?=$arItem["DATE"]?></div>
								<div class="event_slider__item__month"><?=$arItem["MONTH"]?></div>
							</div>
							<div class="col-xs-12 col-sm-7 col-md-8 event_slider__item_wrapper">
								<div class="event_slider__item__name"><?=$arItem["NAME"]?></div>
								<div class="event_slider__item__text"><?=$arItem["~PREVIEW_TEXT"]?></div>
							</div>
							<div class="col-xs-12 col-sm-7 col-sm-offset-6 col-md-8 col-md-offset-4">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="event_slider__item__link"><span>Читать больше &#10132;</span></a>
							</div>					
						</div>
					</div>
				</div>	
			</div>
		<?endforeach?>
	</div>
</div>


	  <div class="col-xs-11 col-xs-offset-1 event__border"></div>

<div class="event__manage">
	<div class="event_pagination">
	  <div class="swiper-pagination_e"></div>
	</div>
	<div class="event_prev" tabindex="0" role="button" aria-label="Previous slide"></div>
	<div class="event_next" tabindex="0" role="button" aria-label="Next slide"></div>
</div>