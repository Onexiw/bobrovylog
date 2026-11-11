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
		
		<a href="/events/" class="news_page__head__back">&#8592; СОБЫТИЯ</a>

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
			

			<?if($arResult["PROPERTIES"]["FORM_SHOW"]["VALUE"] == "Y"):?>
				
					<div class="service__detail_side__email">
						<div class="service__detail_side__email__title" data-toggle="collapse" href="#events_form">&#9654; <?=$arResult["PROPERTIES"]["FORM_TITLE"]["VALUE"]?></div>
						<form action="#" method="post" class="form_check form_style events_form collapse" id="events_form">
						  <p class="rline">
						    <input type="text" class="service_form__name" name="name" placeholder="Имя" autocomplete="off"/>
						  </p>
						  <p class="rline">
						    <input type="tel" class="rfield phonefield service_form__phone" name="phone" placeholder="Телефон" autocomplete="off"/>
						  </p>
							
							<?foreach($arResult["PROPERTIES"]["FORM_FIELD"]["VALUE"] as $k=>$field):?>
								<input type="hidden" name="fld_name_<?=$k?>" value="<?=$field?>">
								<p class="rline">
							    <textarea name="field_<?=$k?>" placeholder="<?=$field?>" autocomplete="off"></textarea>
							  </p>
							<?endforeach?>
		
							<input type="hidden" name="phrase">
							<input type="hidden" name="service_name" value="<?=$arResult["NAME"]?>">
							<input type="hidden" name="service_email" value="<?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?>">
							
							<?if($arResult["PROPERTIES"]["AGREE"]["VALUE"]):?>
								<p class="rline rcheck">
							    <input type="checkbox" class="rfield" id="check_a" checked="checked"/>
							    <label for="check_a"><?=$arResult["PROPERTIES"]["AGREE"]["VALUE"]?></label>
							  </p>
								<input type="hidden" name="check_a" value="<?=$arResult["PROPERTIES"]["AGREE"]["VALUE"]?>">
							<?endif?>
								
						  <p class="rline rcheck">
						    <input type="checkbox" class="rfield" id="check_2" checked="checked"/>
						    <label for="check_2">В соответствии с Федеральным законом «О персональных данных» от 27.07.2006 N 152-ФЗ свободно, своей волей и в своем интересе я даю свое согласие ООО «Ренонс» (Фанпарк «Бобровый лог») на обработку моих персональных данных, указанных при заполнении формы обратной связи на сайте www.bobrovylog.ru</label>
						  </p>
						  
						  <div class="service_form__submit">
							  <button type="submit" class="btnsubmit">Отправить</button>
							</div>
						</form>
					</div>
				
			<?endif?>

			
			<div class="news__detail__item__text">
				<?=$arResult["~DETAIL_TEXT"]?>
			</div>
			
		</div>
	</div>
	
	
	<div class="clear"></div>

	<a href="/events/" class="news_page__head__back">← ВСЕ СОБЫТИЯ</a>

</div>