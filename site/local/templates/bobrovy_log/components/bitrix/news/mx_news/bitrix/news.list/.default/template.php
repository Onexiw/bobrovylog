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

<div id="news-list" class="row news__page__list">
<?//d($arResult["ITEMS"]["FIX"])?>

	<?if($arResult["ITEMS"]["FIX"] && $_REQUEST["tag"] == ''):?>
		<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
			<div class="news__item_big">
				<a href="<?=$arResult["ITEMS"]["FIX"]["DETAIL_PAGE_URL"]?>" class="news__item_big__picture" style="background-image: url(<?=$arResult["ITEMS"]["FIX"]["DETAIL_PICTURE"]?>)">
					<div class="news__item_big__picture__gradient"></div>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="news__item_big__blank">
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
					<a href="<?=$arResult["ITEMS"]["FIX"]["DETAIL_PAGE_URL"]?>" class="news__item_big__arrow">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</a>
				</a>
				<div class="clear"></div>
			</div>
		</div>
	<?endif?>
	
<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem["DETAIL_PICTURE"])?>

<?if($_REQUEST["tag"] == ''): //если не фильтруем по тегам?>

	<?if($arItem["ID"] != $arResult["ITEMS"]["FIX"]["ID"]):?>
		
		<?if($arItem["PROPERTIES"]["BIG"]["VALUE"] != "Y"):?>
			<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
				<div class="news__item">
					
					<?if($arItem["DETAIL_PICTURE"]["ID"] != ""):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__picture">
							<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
							<img src="<?=$file["src"]?>">
							<div class="news__item__picture__gradient"></div>
						</a>
					<?endif?>
					
					<div class="news__item__block">
						<div class="news__item__block__date">
						
							<?if($arItem["PROPERTIES"]["DATE"]["VALUE"] != ""):?>
								
								<?$day=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
								<?$month=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
								<?$year=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>
		
							<?else:?>
							
								<?$day=substr($arItem["DATE_CREATE"], 0, 2)?>
								<?$month=substr($arItem["DATE_CREATE"], 3, 2)?>
								<?$year=substr($arItem["DATE_CREATE"], 6, 4)?>
								
							<?endif?>
		
								<?$m = Array(
									"01" => 'января',
									"02" => 'февраля',
									"03" => 'марта',
									"04" => 'апреля',
									"05" => 'мая',
									"06" => 'июня',
									"07" => 'июля',
									"08" => 'августа',
									"09" => 'сентября',
									"10" => 'октября',
									"11" => 'ноября',
									"12" => 'декабря',
								);
								?>
							
							
							🗓 <?echo $day.' '.$m[$month].' '.$year?>
						</div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__block__title"><?=$arItem["NAME"]?></a>
						<div class="news__item__block__text">
							<?echo strip_tags($arItem["DETAIL_TEXT"]);?>
						</div>
						<div class="news__item__block__shadow"></div>
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
						<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="news__item_big__blank">
						<div class="news__item_big_wrapper">
							<div class="news__item_big__block">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_big__block__title"><?=$arItem["NAME"]?></a>
							</div>
							
							<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ''):?>
								<div class="news__item_big__block__photograph">📷 <?=$arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
							<?endif?>
						
							<?if($arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
								<div class="news__item_big__block__author">❄️ <?=$arResult["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
							<?endif?>
						</div>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_big__arrow">
							<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</a>
					</a>
				</div>
				<div class="clear"></div>
			</div>
		<?endif?>

	<?endif?>
	
<?else: //иначе если фильтруем по тегам?>
		
		<?if($arItem["PROPERTIES"] != ""): //защита от мусорных элементов?>
			<?if($arItem["PROPERTIES"]["BIG"]["VALUE"] != "Y"):?>
				<div class="col-xs-12 col-sm-6 col-md-4 news__item_wrapper">
					<div class="news__item">
						
						<?if($arItem["DETAIL_PICTURE"]["ID"] != ""):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__picture">
								<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>720, 'height'=>720), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
								<img src="<?=$file["src"]?>">
								<div class="news__item__picture__gradient"></div>
							</a>
						<?endif?>
						
						<div class="news__item__block">
							<div class="news__item__block__date">
							
								<?if($arItem["PROPERTIES"]["DATE"]["VALUE"] != ""):?>
									
									<?$day=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
									<?$month=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
									<?$year=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>
			
								<?else:?>
								
									<?$day=substr($arItem["DATE_CREATE"], 0, 2)?>
									<?$month=substr($arItem["DATE_CREATE"], 3, 2)?>
									<?$year=substr($arItem["DATE_CREATE"], 6, 4)?>
									
								<?endif?>
			
									<?$m = Array(
										"01" => 'января',
										"02" => 'февраля',
										"03" => 'марта',
										"04" => 'апреля',
										"05" => 'мая',
										"06" => 'июня',
										"07" => 'июля',
										"08" => 'августа',
										"09" => 'сентября',
										"10" => 'октября',
										"11" => 'ноября',
										"12" => 'декабря',
									);
									?>
								
								
								🗓 <?echo $day.' '.$m[$month].' '.$year?>
							</div>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item__block__title"><?=$arItem["NAME"]?></a>
							<div class="news__item__block__text">
								<?echo strip_tags($arItem["DETAIL_TEXT"]);?>
							</div>
							<div class="news__item__block__shadow"></div>
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
							<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_440_620.png" class="news__item_big__blank">
							<div class="news__item_big_wrapper">
								<div class="news__item_big__block">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_big__block__title"><?=$arItem["NAME"]?></a>
								</div>
								
								<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ''):?>
									<div class="news__item_big__block__photograph">📷 <?=$arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
								<?endif?>
							
								<?if($arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
									<div class="news__item_big__block__author">❄️ <?=$arResult["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
								<?endif?>
							</div>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__item_big__arrow">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 8H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									<path d="M8 1L15 8L8 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
								</svg>
							</a>
						</a>
					</div>
					<div class="clear"></div>
				</div>
			<?endif?>
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
/*
	$('.news__item__block').dotdotdot({
		watch: "true",
	});
*/
	
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
	timeoutID = setTimeout(function(){wowwowwow();}, 100);

});
</script>
<!--RestartBuffer-->

</div>
<div class="clear"></div>
