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
	<div class="col-xs-12 col-sm-8 news_page__head news_page__head_detail">
		
		<a href="/news/" class="news_page__head__back">&#8592; НОВОСТИ</a>

			<div class="news_page__head__social__links">
				<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/social.php"
						)
					);?>
			</div>
			<div class="news_page__head__social__title">Мы в соцсетях</div>

	</div>
</div>

<div id="news-list" class="row news__detail">
<?//d($arResult)?>
	<div class="col-xs-12 col-sm-8">
		<div class="news__detail__item">
			<?if($arResult["DETAIL_PICTURE"]["SRC"] != ''):?>
				<div class="news__detail__item__picture">
					<img src="<?=SITE_TEMPLATE_PATH?>/images/loading.gif" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="lazyload news__detail__item__picture__img">
				</div>
			<?endif?>
			<div class="news__detail__item__title">
				<h1><?=$arResult["NAME"]?></h1>
			</div>
			
			<div class="news__detail__item__autor">
				
				<div class="news__detail__item__autor__date">
					
					<?if($arResult["PROPERTIES"]["DATE"]["VALUE"] != ""):?>

						<?$day=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
						<?$month=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
						<?$year=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>

					<?else:?>
					
						<?$day=substr($arResult["DATE_CREATE"], 0, 2)?>
						<?$month=substr($arResult["DATE_CREATE"], 3, 2)?>
						<?$year=substr($arResult["DATE_CREATE"], 6, 4)?>
						
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
				
				<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != ''):?>
					<div class="news__detail__item__autor__photograph">📷 <?=$arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"]?></div>
				<?endif?>

				<?if($arResult["PROPERTIES"]["PHOTOGRAPH"]["VALUE"] != '' && $arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
					<div class="news__detail__item__autor__divider"> / </div>
				<?endif?>
			
				<?if($arResult["PROPERTIES"]["AUTHOR"]["VALUE"] != ''):?>
					<div class="news__detail__item__autor__author">❄️ <?=$arResult["PROPERTIES"]["AUTHOR"]["VALUE"]?></div>
				<?endif?>
			</div>

			<div class="news__detail__item__text">
				<?=$arResult["~DETAIL_TEXT"]?>
			</div>
			
		</div>
	</div>
	<div class="clear"></div>

	<?if($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["VALUE"] != ''):?>
		<div class="col-xs-12">
			<div class="news__detail__gallery">
				<?foreach($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] as $g => $arPhoto):?>
					<a data-fancybox="gallery" href="<?=$arPhoto["SRC"]?>" class="news__detail__gallery__picture">
						<?$file = CFile::ResizeImageGet($arPhoto["ID"], array('width'=>800, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>               
						<img src="<?=SITE_TEMPLATE_PATH?>/images/loading-512.gif" data-src="<?=$file["src"]?>" class="lazyload news__detail__gallery__picture__img">
					</a>
				<?endforeach?>
			</div>
		</div>
	<?endif?>

</div>

<script>
	$('document').ready(function(){
		$('.news__detail__item__text table').addClass('table');
		$('.news__detail__item__text table').wrap('<div class="table-responsive"></div>');
		$('.news__detail__item__text *').removeAttr('style');
		$('.news__detail__item__text table p').css({
																									'padding-bottom': '0px',
																									'font-size': '14px',
																									'line-height': '20px'
																							});
	});
</script>