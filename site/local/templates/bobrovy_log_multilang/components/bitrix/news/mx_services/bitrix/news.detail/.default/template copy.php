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

<div class="service__detail">
	<?//d($arResult)?>
	
<?if(!empty($arResult["PHOTOS"])):?>
	<div class="swiper-container service__detail__slider">

	  <div class="swiper-wrapper">
		  <div class="swiper-slide">
			  <div class="service__detail__slider__item swiper-lazy" data-background="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" >
				  <div class="swiper-lazy-preloader"></div>
				  
				  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png"  data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="service__detail__slider__item_blank swiper-lazy">
				  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="service__detail__slider__item_mobile">
				  
				</div>
		  </div>
			<?foreach($arResult["PHOTOS"] as $k => $arPhoto):?>
			  <div class="swiper-slide">
				  <div class="service__detail__slider__item swiper-lazy" data-background="<?=$arPhoto?>" >
					  <div class="swiper-lazy-preloader"></div>
					  
					  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png"  data-src="<?=$arPhoto?>" class="service__detail__slider__item_blank swiper-lazy">
				  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="service__detail__slider__item_mobile">
					  
					</div>
			  </div>
			<?endforeach;?>
	  </div>
	
	  <div class="service__detail__slider__nav_page">
		  
		  <div class="service__detail__slider__nav_page__title"><?=$arResult["NAME"]?></div>
		  
		  <div class="service__detail__slider__nav_page__pagination">
			  <!-- If we need pagination -->
			  <div class="swiper-pagination_s"></div>
			</div>
			<!-- If we need navigation buttons -->
	    <div class="service_prev">
		    <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.5 30C7.45228 30 1 23.5477 1 15.5C1 7.45228 7.45228 1 15.5 1C23.5477 1 30 7.45228 30 15.5C30 23.5477 23.5477 30 15.5 30Z" stroke="white" stroke-width="2" stroke-miterlimit="10" class="service_prev__path1"/>
				<path d="M23.0996 15.1H10.0996" stroke="white" stroke-width="2" stroke-miterlimit="10" class="service_prev__path2"/>
				<path d="M16.7995 7L18.0995 8.5L10.8995 15.2L18.0995 21.9L16.7995 23.3L7.99951 15.2L16.7995 7Z" fill="white" class="service_prev__path3"/>
				</svg>
	
	    </div>
	    <div class="service_next">
		    <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15.5 30C7.45228 30 1 23.5477 1 15.5C1 7.45228 7.45228 1 15.5 1C23.5477 1 30 7.45228 30 15.5C30 23.5477 23.5477 30 15.5 30Z" stroke="white" stroke-width="2" stroke-miterlimit="10" class="service_next__path1"/>
				<path d="M21 15.1H8" stroke="white" stroke-width="2" stroke-miterlimit="10" class="service_next__path2"/>
				<path d="M14.1 7L12.8 8.5L20 15.2L12.8 21.9L14.1 23.3L22.9 15.2L14.1 7Z" fill="white"class="service_next__path3"/>
				</svg>
	    </div>
		</div>
	

	</div>
<?else:?>
	<div class="service__detail__slider_simple">
	  <div class="lazyload service__detail__slider__item" data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">				  
		  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png"  data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="service__detail__slider__item_blank swiper-lazy">
		  <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" class="service__detail__slider__item_mobile">


		</div>
		
	  <div class="service__detail__slider__nav_page">
		  <div class="service__detail__slider__nav_page__title">
			  <?if($arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]["TEXT"] != ""):?>
			  	<?=$arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]["TEXT"]?>
			  <?else:?>
				  <?=$arResult["NAME"]?>
			  <?endif?>
			  
			  </div>
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
								    <textarea name="field_<?=$k?>" placeholder="<?=$field?>" autocomplete="off"/></textarea>
								  </p>
								<?endforeach?>

								<input type="hidden" name="phrase">
								<input type="hidden" name="service_name" value="<?=$arResult["NAME"]?>">
								<input type="hidden" name="service_email" value="<?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?>">
								
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
				
				
<?
global $USER;
if ($USER->IsAdmin()):?>
			<div class="service__detail_side__work__status">

				<?if($arResult["PROPERTIES"]["MON"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["TUE"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["WED"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["THU"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["FRI"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["SAT"]["VALUE"] !="" || 
						$arResult["PROPERTIES"]["SUN"]["VALUE"] !=""
					):?>
						<div class="service__detail_side__work__status__title">&#9654; Статус</div>
						
						<?
						$day_of_a_week = strtoupper(date("D"));
						$time_now = (int)date("H");
						
						//d($day_of_a_week);
						//d($time_now);
																		
						if($arResult["PROPERTIES"][$day_of_a_week]["VALUE"] <= $time_now && $arResult["PROPERTIES"][$day_of_a_week]["DESCRIPTION"] > $time_now) {
							$opened = 'Открыто';
							$openedClass = 'opened';
						} else {
							$opened =  'Закрыто';
							$openedClass = 'closed';
						}


						//d($opened);
						//d($openedClass);

						?>
						
						<div class="service__detail_side__work__status__value <?=$openedClass?>"><?=$opened?></div>
				<?endif?>
					</div>

<?endif?>
					
					<div class="service__detail_side__work__text">
						<?if($arResult["PROPERTIES"]["WORK_TIME"]["VALUE"] != ""):?>
							<div class="service__detail_side__work__text__title">&#9654; Время работы</div>
							<div class="service__detail_side__work__text__description"><?=$arResult["PROPERTIES"]["WORK_TIME"]["~VALUE"]["TEXT"]?></div>
						<?endif?>

					</div>
					
					<?if($arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]["TEXT"] != ""):?>
						<div class="service__detail_side__additional"><?=$arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]["TEXT"]?></div>
					<?endif?>
					
					<?if($arResult["PROPERTIES"]["PRICES"]["VALUE"] != ""):?>
					<div class="service__detail_side__prices">
						<?//if($arResult["PROPERTIES"]["PRICES"]["VALUE"] != ""):?>
							<div class="service__detail_side__prices__title">&#9654; Цены</div>
							<div class="service__detail_side__prices__description"><?=$arResult["PROPERTIES"]["PRICES"]["~VALUE"]["TEXT"]?></div>
						<?//endif?>
					</div>
					<?endif?>

					<?if($arResult["PROPERTIES"]["TABLES"]["VALUE"] != ""):?>
						<div class="service__detail_side__prices__description">
							<a href="#more_prices" class="service__detail_side__prices__link scroll">Смотреть цены</a>
						</div>
					<?endif?>

					
					<?if($arResult["PROPERTIES"]["MAP_LINK"]["VALUE"] != ""):?>
						<div class="service__detail_side__routes">
							<a href="<?=$arResult["PROPERTIES"]["MAP_LINK"]["VALUE_XML_ID"]?>" class="service__detail_side__routes__title">&#9654; Карта трасс</a>

							<?							
							switch ($arResult["PROPERTIES"]["MAP_LINK"]["VALUE"]) {
							    case "Зимняя карта":
							        $iconmap =  "icon_map_winter";
							        break;
							    case "Летняя карта":
							        $iconmap =  "icon_map_summer";
							        break;
							    default:
							       $iconmap = "";
							}
							?>
							<a href="<?=$arResult["PROPERTIES"]["MAP_LINK"]["VALUE_XML_ID"]?>" class="service__detail_side__routes__icon" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/<?=$iconmap?>.png)"></a>
							
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
</div>