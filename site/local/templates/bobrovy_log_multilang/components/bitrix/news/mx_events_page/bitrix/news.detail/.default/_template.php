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

<div class="service__detail event_detail">
	<?//d($arResult)?>
	
<?if($arResult["DETAIL_PICTURE"]["SRC"] != ''):?>

	<div class="service__detail__slider_simple">
	  <div class="lazyload service__detail__slider__item" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">				  
		  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png"  data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="service__detail__slider__item_blank swiper-lazy">
		  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="service__detail__slider__item_mobile">
		</div>
		
	</div>
<?endif?>

	
	<div class="service__detail_wrapper">
		<div class="col-xs-12 col-sm-8">		
			<div class="service__detail__title"><h1><?=$arResult["NAME"]?></h1></div>
		</div>
		
		<div class="col-xs-12 col-sm-4 service__detail_side">
			
			<div class="service__detail_side_wrapper">
				<div class="service__detail_side__title"><?=$arResult["PROPERTIES"]["EXACT_NAME"]["VALUE"]?></div>
			
					<?if($arResult["PROPERTIES"]["FORM_SHOW"]["VALUE"] == "Y"):?>
						<div class="service__detail_side__email">
							<div class="service__detail_side__email__title">&#9654; Оставить заявку</div>
							<form action="#" method="post" class="form_check form_style service_form">
							  <p class="rline">
							    <input type="text" class="service_form__name" name="name" placeholder="Имя" autocomplete="off"/>
							  </p>
							  <p class="rline">
							    <input type="tel" class="rfield phonefield service_form__phone" name="phone" placeholder="Телефон" autocomplete="off"/>
							  </p>
								
								<?foreach($arResult["PROPERTIES"]["FORM_FIELD"]["VALUE"] as $k=>$field):?>
									<input type="hidden" name="fld_name_<?=$k?>" value="<?=$field?>">
									<p class="rline">
								    <textarea name="field_<?=$k?>" placeholder="<?=$field?>"/></textarea>
								  </p>
								<?endforeach?>

								<input type="hidden" name="phrase">
								<input type="hidden" name="service_name" value="<?=$arResult["NAME"]?>">
								
							  <p class="rline rcheck">
							    <input type="checkbox" class="rfield" id="check_2" checked="checked"/>
							    <label for="check_2">В соответствии с Федеральным законом «О персональных данных» от 27.07.2006 N 152-ФЗ свободно, своей волей и в своем интересе я даю свое согласие ПАО «ГМК Норильский никель» на обработку моих персональных данных, указанных при заполнении формы обратной связи на сайте www.nornickel.ru</label>
							  </p>
							  
							  <div class="service_form__submit">
								  <button type="submit" class="btnsubmit">Отправить</button>
								</div>
							</form>
						</div>
					<?endif?>
				
			</div>
		</div>
		
		<div class="col-xs-12 col-sm-8 service__detail_part">
		
			<div class="service__detail__text"><?=$arResult["~DETAIL_TEXT"]?></div>
			
			<?if($arResult["PROPERTIES"]["SHOW_TITLE"]["VALUE"] != ""):?>
				<a class="service__detail__show_title collapsed" data-toggle="collapse" href="#show_text" aria-expanded="false" aria-controls="show_text"><?=$arResult["PROPERTIES"]["SHOW_TITLE"]["VALUE"]?></a>
				<div class="collapse service__detail__show_text" id="show_text"><?=$arResult["PROPERTIES"]["SHOW_TEXT"]["~VALUE"]["TEXT"]?></div>
			<?endif?>
			
			<?if($arResult["PROPERTIES"]["TABLES"]["VALUE"] != ""):?>
				<div class="service__detail__tables" id="more_prices">
					<?foreach($arResult["PROPERTIES"]["TABLES"]["VALUE"] as $t => $arTable):?>
						<div class="service__detail__tables__title"><?=$arResult["PROPERTIES"]["TABLES"]["DESCRIPTION"][$t]?></div>
						<div class="service__detail__tables__picture_wrapper">
							<img src="<?=SITE_TEMPLATE_PATH?>/images/loading.gif" data-src="<?=CFile::GetPath($arTable)?>" class="lazyload service__detail__tables__picture" draggable="true" >
						</div>
					<?endforeach?>
				</div>
			<?endif?>


			<div class="clear"></div>
		</div>
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="clear"></div>

	</div>
	<a href="/news/" class="news_page__head__back">← ВСЕ СОБЫТИЯ</a>
</div>