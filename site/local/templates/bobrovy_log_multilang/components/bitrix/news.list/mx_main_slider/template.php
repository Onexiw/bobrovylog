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

	<div class="main_slider__mobile">
	  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="main_slider__mobile__img">
  </div>
  
  <div class="swiper-wrapper">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		
		  <div class="swiper-slide">
			  <div class="main_slider__item swiper-lazy" data-background="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" >
				  <div class="swiper-lazy-preloader"></div>

				  <?//if($arItem["PROPERTIES"]["PICTURE_MOBILE"]["VALUE"] != ''):?>
					  <?//$file = CFile::ResizeImageGet($arItem["PROPERTIES"]["PICTURE_MOBILE"]["VALUE"], array('width'=>768, 'height'=>768), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						  //$picture = $file["src"];
					  ?>
				  <?//else:?>
				  	<?//$picture = $arItem["DETAIL_PICTURE"]["SRC"]?>
				  <?//endif?>
				 
				  
				  <div class="main_slider__item__mobile swiper-lazy"  data-background="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
				  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png"  class="main_slider__item__blank">
				  </div>
				  
				  <div class="main_slider__block">
					  <div class="main_slider__item__big_text"><?=LANGUAGE_ID == 'en' ? (is_array($arItem["PROPERTIES"]["BIG_TEXT_EN"]["~VALUE"]) ? $arItem["PROPERTIES"]["BIG_TEXT_EN"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["BIG_TEXT_EN"]["~VALUE"]) : (is_array($arItem["PROPERTIES"]["BIG_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["BIG_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["BIG_TEXT"]["~VALUE"])?></div>
					  <div class="main_slider__item__big_text_m"><?=LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["BIG_TEXT_MOBILE_EN"]["VALUE"] : $arItem["PROPERTIES"]["BIG_TEXT_MOBILE"]["VALUE"]?></div>
					  
					  <?if($arItem["PROPERTIES"]["LINK"]["VALUE"] != ''):?>
					  	<?$nobutton = "";?>
					  <?else:?>
					  	<?$nobutton = "nobutton";?>
					  <?endif?>
					  <div class="main_slider__item__small_text <?=$nobutton?>"><?=LANGUAGE_ID == 'en' ? (is_array($arItem["PROPERTIES"]["SMALL_TEXT_EN"]["~VALUE"]) ? $arItem["PROPERTIES"]["SMALL_TEXT_EN"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["SMALL_TEXT_EN"]["~VALUE"]) : (is_array($arItem["PROPERTIES"]["SMALL_TEXT"]["~VALUE"]) ? $arItem["PROPERTIES"]["SMALL_TEXT"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["SMALL_TEXT"]["~VALUE"])?></div>
					  
					  
					  <?if($arItem["PROPERTIES"]["LINK"]["VALUE"] != ''):?>
						  <a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" class="main_slider__item__button"><?=LANGUAGE_ID == 'en' ? "Learn more" : "Узнать больше"?></a>
						<?endif?>
						
					</div>
				</div>
		  </div>
		
		<?endforeach;?>
  </div>

  <div class="main_slider__nav_page">
	  <div class="main_slider__nav_page__pagination">
		  <!-- If we need pagination -->
		  <div class="swiper-pagination_d"></div>
		</div>
		<!-- If we need navigation buttons -->
    <div class="slider_prev">
	    <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.5 30C7.45228 30 1 23.5477 1 15.5C1 7.45228 7.45228 1 15.5 1C23.5477 1 30 7.45228 30 15.5C30 23.5477 23.5477 30 15.5 30Z" stroke="white" stroke-width="2" stroke-miterlimit="10" class="slider_prev__path1"/>
			<path d="M23.0996 15.1H10.0996" stroke="white" stroke-width="2" stroke-miterlimit="10" class="slider_prev__path2"/>
			<path d="M16.7995 7L18.0995 8.5L10.8995 15.2L18.0995 21.9L16.7995 23.3L7.99951 15.2L16.7995 7Z" fill="white" class="slider_prev__path3"/>
			</svg>

    </div>
    <div class="slider_next">
	    <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15.5 30C7.45228 30 1 23.5477 1 15.5C1 7.45228 7.45228 1 15.5 1C23.5477 1 30 7.45228 30 15.5C30 23.5477 23.5477 30 15.5 30Z" stroke="white" stroke-width="2" stroke-miterlimit="10" class="slider_next__path1"/>
			<path d="M21 15.1H8" stroke="white" stroke-width="2" stroke-miterlimit="10" class="slider_next__path2"/>
			<path d="M14.1 7L12.8 8.5L20 15.2L12.8 21.9L14.1 23.3L22.9 15.2L14.1 7Z" fill="white"class="slider_next__path3"/>
			</svg>
    </div>
	</div>


