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
<div class="row">
	<div class="col-xs-12 news_page__head">
		
		<div class="news_page__head__title">Новости</div>

			<div class="news_page__head__social__title">Мы в соцсетях</div>
			<div class="news_page__head__social__links">
				<div class="news_main__social__links__item">
					<a href="https://www.facebook.com/bobrovylog" class="news_main__social__links__item__icon item__icon_fb"></a>
				</div>
				<div class="news_main__social__links__item">
					<a href="https://vk.com/bobrovylog" class="news_main__social__links__item__icon item__icon_vk"></a>
				</div>
				<div class="news_main__social__links__item">
					<a href="https://www.instagram.com/bobrolog/" class="news_main__social__links__item__icon item__icon_inst"></a>
				</div>
			</div>

	</div>
</div>

<div id="news-list" class="row news__page__list">
<?//d($arResult["ITEMS"]["FIX"])?>

	<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
		<div class="news__item_big">
			<a href="<?=$arResult["ITEMS"]["FIX"]["DETAIL_PAGE_URL"]?>" class="lazyload news__item_big__picture" data-src="<?=$arResult["ITEMS"]["FIX"]["DETAIL_PICTURE"]?>">
				<div class="news__item_big__picture__gradient"></div>
				<img src="<?=SITE_TEMPLATE_PATH?>/images/loading-512.gif" data-src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="lazyload news__item_big__blank">
				<div class="news__item_big_wrapper">
					<div class="news__item_big__block">
						<div class="news__item_big__block__title"><?=$arResult["ITEMS"]["FIX"]["NAME"]?></div>
					</div>
					
					<?if($arResult["ITEMS"]["FIX"]["PHOTOGRAPH"] != ''):?>
						<div class="news__item_big__block__photograph">📷 <?=$arResult["ITEMS"]["FIX"]["PHOTOGRAPH"]?></div>
					<?endif?>
				
					<?if($arResult["ITEMS"]["FIX"]["AUTHOR"] != ''):?>
						<div class="news__item_big__block__author">❄️ <?=$arResult["ITEMS"]["FIX"]["AUTHOR"]?></div>
					<?endif?>
				</div>
				<div class="news__item_big__arrow">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</div>
			</a>
			<div class="clear"></div>
		</div>
	</div>
	
<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem["DETAIL_PICTURE"])?>
	<?if($arItem["ID"] != $arResult["ITEMS"]["FIX"]["ID"]):?>
		
		<?if($arItem["PROPERTIES"]["BIG"]["VALUE"] != "Y"):?>
			<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
				<div class="news__item">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__picture">
						<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/loading-512.gif" data-src="<?=$file["src"]?>" class="lazyload">
						<div class="news__item__picture__gradient"></div>
					</a>
					<div class="news__item__block">
						<div class="news__item__block__title"><?=$arItem["NAME"]?></div>
						<div class="news__item__block__text">
							<?echo strip_tags($arItem["DETAIL_TEXT"]);?>
						</div>
					</div>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__link"><span>Читать больше &#10132;</span></a>
				</div>
				<div class="clear"></div>
			</div>
		<?else:?>
			<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
				<div class="news__item_big">
					<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="lazyload news__item_big__picture" data-src="<?=$file["src"]?>">
						<div class="news__item_big__picture__gradient"></div>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/loading-512.gif" data-src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="lazyload news__item_big__blank">
						<div class="news__item_big_wrapper">
							<div class="news__item_big__block">
								<div class="news__item_big__block__title"><?=$arItem["NAME"]?></div>
							</div>
							
							<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ''):?>
								<div class="news__item_big__block__photograph">📷 <?=$arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
							<?endif?>
						
							<?if($arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
								<div class="news__item_big__block__author">❄️ <?=$arResult["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
							<?endif?>
						</div>
						<div class="news__item_big__arrow">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</div>
					</a>
				</div>
				<div class="clear"></div>
			</div>
		<?endif?>
	<?endif?>
<?endforeach;?>
<?php
$paramName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;
 
if ($paramValue < $pageCount) {
    $paramValue = (int) $paramValue + 1;
    $url = htmlspecialcharsbx(
        $APPLICATION->GetCurPageParam(
            sprintf('%s=%s', $paramName, $paramValue), 
            array($paramName, 'AJAX_PAGE',)
        )
    );
    echo sprintf('<div class="ajax-pager-wrap">
                      <a class="ajax-pager-link" data-wrapper-class="news__page__list" href="%s"></a>
                  </div>',
        $url);
}
?>
<script>
$(document).ready(function(){
	$('.news__item__block').dotdotdot({
		watch: "true",
	});
	
		//включаем lazyload
	let images = document.querySelectorAll(".lazyload");
	lazyload(images);

	
	
	//расставляем новости в разделе news
	var $ngrid = $('.news__page__list').masonry({
		initLayout: false,
		itemSelector: '.news__item_wrapper'
	});

	// layout Masonry after each image loads
/*
	$ngrid.imagesLoaded().progress( function() {
	  $ngrid.masonry('layout');
	});
*/

	function wowwowwow() {
		$ngrid.masonry('reloadItems');
		$ngrid.masonry('layout');
	}
	timeoutID = setTimeout(function(){wowwowwow();}, 300);

});
</script>
<!--RestartBuffer-->

</div>
<div class="clear"></div>
