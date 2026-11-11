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
		  
		  <div class="service__detail__slider__nav_page__title"><?=LANGUAGE_ID == 'en' ? $arResult["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arResult["NAME"]?></div>
		  
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
			<?if(LANGUAGE_ID != 'en'):?>
			  <div class="service__detail__slider__nav_page__title">
				  <?if((is_array($arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]) ? $arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]) != ""):?>
				  	<?=(is_array($arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]) ? $arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["HTML_NAME"]["~VALUE"])?>
				  <?else:?>
					  <?=$arResult["NAME"]?>
				  <?endif?>			  
				</div>
			<?else:?>
			  <div class="service__detail__slider__nav_page__title">
				  <?if((is_array($arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"]) != ""):?>
				  	<?=(is_array($arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["HTML_NAME_ENG"]["~VALUE"])?>
				  <?else:?>
					  <?=$arResult["PROPERTIES"]["NAME_ENG"]["VALUE"]?>
				  <?endif?>			  
				</div>
			<?endif?>
		</div>


	</div>
<?endif?>

	
	<div class="service__detail_wrapper">
		<div class="col-xs-12 col-sm-8">		
			<div class="service__detail__title"><h1><?=LANGUAGE_ID == 'en' ? $arResult["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arResult["NAME"]?></h1></div>
		</div>
		
		<div class="col-xs-12 col-sm-4 service__detail_side">
			
			<div class="service__detail_side_wrapper">
				<div class="service__detail_side__title"><?=LANGUAGE_ID == 'en' ? $arResult["PROPERTIES"]["EXACT_NAME_ENG"]["VALUE"] : $arResult["PROPERTIES"]["EXACT_NAME"]["VALUE"]?></div>
			
					<?if($arResult["PROPERTIES"]["FORM_SHOW"]["VALUE"] == "Y"):?>
						<div class="service__detail_side__email">
							<div class="service__detail_side__email__title">&#9654; <?=GetMessage("leave_request")?></div>
							<form action="#" method="post" class="form_check form_style service_form">
							  <p class="rline">
							    <input type="text" class="service_form__name" name="name" placeholder="<?=GetMessage("form_name")?>" autocomplete="off"/>
							  </p>
							  <p class="rline">
							    <input type="tel" class="rfield phonefield service_form__phone" name="phone" placeholder="<?=GetMessage("form_phone")?>" autocomplete="off"/>
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
							    <label for="check_2"><?=GetMessage("fz")?></label>
							  </p>
							  
							  <div class="service_form__submit">
								  <button type="submit" class="btnsubmit"><?=GetMessage("submit_otpravit")?></button>
								</div>
							</form>
						</div>
					<?endif?>
				
				
<?
global $USER;
if ($USER->IsAdmin()):?>
	<div class="service__detail_side__work__status">
	
	</div>
<?endif?>

				<?if(LANGUAGE_ID != 'en'):?>
					<div class="service__detail_side__work__text">
						<?if($arResult["PROPERTIES"]["WORK_TIME"]["VALUE"] != ""):?>
							<div class="service__detail_side__work__text__title">&#9654; Время работы</div>
							<div class="service__detail_side__work__text__description"><?=(is_array($arResult["PROPERTIES"]["WORK_TIME"]["~VALUE"]) ? $arResult["PROPERTIES"]["WORK_TIME"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["WORK_TIME"]["~VALUE"])?></div>
						<?endif?>
					</div>
				<?else:?>
					<div class="service__detail_side__work__text">
						<?if($arResult["PROPERTIES"]["WORK_TIME_ENG"]["VALUE"] != ""):?>
							<div class="service__detail_side__work__text__title">&#9654; Work time</div>
							<div class="service__detail_side__work__text__description"><?=(is_array($arResult["PROPERTIES"]["WORK_TIME_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["WORK_TIME_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["WORK_TIME_ENG"]["~VALUE"])?></div>
						<?endif?>
					</div>
				<?endif?>
				
					
				<?if(LANGUAGE_ID != 'en'):?>
					<?if((is_array($arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]) ? $arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]) != ""):?>
						<div class="service__detail_side__additional"><?=(is_array($arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]) ? $arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["ADDITIONAL"]["~VALUE"])?></div>
					<?endif?>
				<?else:?>
					<?if((is_array($arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"]) != ""):?>
						<div class="service__detail_side__additional"><?=(is_array($arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["ADDITIONAL_ENG"]["~VALUE"])?></div>
					<?endif?>
				<?endif?>
				
					
				<?if(LANGUAGE_ID != 'en'):?>
					<?if($arResult["PROPERTIES"]["PRICES"]["VALUE"] != ""):?>
						<div class="service__detail_side__prices">
							<?//if($arResult["PROPERTIES"]["PRICES"]["VALUE"] != ""):?>
								<div class="service__detail_side__prices__title">&#9654; Цены</div>
								<div class="service__detail_side__prices__description"><?=(is_array($arResult["PROPERTIES"]["PRICES"]["~VALUE"]) ? $arResult["PROPERTIES"]["PRICES"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["PRICES"]["~VALUE"])?></div>
							<?//endif?>
						</div>
					<?endif?>
				<?else:?>
					<?if($arResult["PROPERTIES"]["PRICES_ENG"]["VALUE"] != ""):?>
						<div class="service__detail_side__prices">
							<?//if($arResult["PROPERTIES"]["PRICES"]["VALUE"] != ""):?>
								<div class="service__detail_side__prices__title">&#9654; Prices</div>
								<div class="service__detail_side__prices__description"><?=(is_array($arResult["PROPERTIES"]["PRICES_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["PRICES_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["PRICES_ENG"]["~VALUE"])?></div>
							<?//endif?>
						</div>
					<?endif?>
				<?endif?>
				

				<?if(LANGUAGE_ID != 'en'):?>
					<?if($arResult["PROPERTIES"]["TABLES"]["VALUE"] != ""):?>
						<div class="service__detail_side__prices__description">
							<a href="#more_prices" class="service__detail_side__prices__link scroll">Смотреть цены</a>
						</div>
					<?endif?>
				<?else:?>
					<?if($arResult["PROPERTIES"]["TABLES_ENG"]["VALUE"] != ""):?>
						<div class="service__detail_side__prices__description">
							<a href="#more_prices" class="service__detail_side__prices__link scroll">Prices</a>
						</div>
					<?endif?>
				<?endif?>

					
					<?if($arResult["PROPERTIES"]["MAP_LINK"]["VALUE"] != ""):?>
						<div class="service__detail_side__routes">
							<a href="<?=$arResult["PROPERTIES"]["MAP_LINK"]["VALUE_XML_ID"]?>" class="service__detail_side__routes__title">&#9654; <?=GetMessage("routes_map")?></a>

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
		
			<div class="service__detail__text"><?=LANGUAGE_ID == 'en' ? (is_array($arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) : $arResult["~DETAIL_TEXT"]?></div>
			
			
			<?if(LANGUAGE_ID != 'en'): //скрывающийся текст?>

				<?if($arResult["PROPERTIES"]["SHOW_TITLE"]["VALUE"] != ""):?>
					<a class="service__detail__show_title collapsed" data-toggle="collapse" href="#show_text" aria-expanded="false" aria-controls="show_text"><?=$arResult["PROPERTIES"]["SHOW_TITLE"]["VALUE"]?></a>
					<div class="collapse service__detail__show_text" id="show_text"><?=(is_array($arResult["PROPERTIES"]["SHOW_TEXT"]["~VALUE"]) ? $arResult["PROPERTIES"]["SHOW_TEXT"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SHOW_TEXT"]["~VALUE"])?></div>
				<?endif?>

			<?else:?>

				<?if($arResult["PROPERTIES"]["SHOW_TITLE_ENG"]["VALUE"] != ""):?>
					<a class="service__detail__show_title collapsed" data-toggle="collapse" href="#show_text" aria-expanded="false" aria-controls="show_text"><?=$arResult["PROPERTIES"]["SHOW_TITLE_ENG"]["VALUE"]?></a>
					<div class="collapse service__detail__show_text" id="show_text"><?=(is_array($arResult["PROPERTIES"]["SHOW_TEXT_ENG"]["~VALUE"]) ? $arResult["PROPERTIES"]["SHOW_TEXT_ENG"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["SHOW_TEXT_ENG"]["~VALUE"])?></div>
				<?endif?>
			
			<?endif?>
			
			<?if(LANGUAGE_ID == '666'): //закрываем от показа эти таблицы-картинки?>

			
			<?if(LANGUAGE_ID != 'en'): //таблицы с ценами?>
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
			
			<?else:?>

				<?if($arResult["PROPERTIES"]["TABLES_ENG"]["VALUE"] != ""):?>
					<div class="service__detail__tables" id="more_prices">
						<?foreach($arResult["PROPERTIES"]["TABLES_ENG"]["VALUE"] as $t => $arTable):?>
							<div class="service__detail__tables__title"><?=$arResult["PROPERTIES"]["TABLES_ENG"]["DESCRIPTION"][$t]?></div>
							<div class="service__detail__tables__picture_wrapper">
								<img src="<?=SITE_TEMPLATE_PATH?>/images/loading.gif" data-src="<?=CFile::GetPath($arTable)?>" class="lazyload service__detail__tables__picture" draggable="true" >
							</div>
						<?endforeach?>
					</div>
				<?endif?>
			
			<?endif?>
			
			<?endif?>
			
			

			<?if(LANGUAGE_ID != 'en'): //таблицы HTML с ценами?>
				<?if($arResult["PROPERTIES"]["HTML_TABLE"]["VALUE"] != ""):?>
					<div class="service__detail__tables" id="more_prices">
						<?foreach($arResult["PROPERTIES"]["HTML_TABLE"]["~VALUE"] as $t => $arTable):?>
							<div class="service__detail__tables__title"><?=$arResult["PROPERTIES"]["HTML_TABLE"]["DESCRIPTION"][$t]?></div>
							<div class="service__detail__tables__picture_wrapper">
								<?=$arTable["TEXT"]?>
							</div>
						<?endforeach?>
					</div>
				<?endif?>
			<?else:?>
				<?if($arResult["PROPERTIES"]["HTML_TABLE_ENG"]["VALUE"] != ""):?>
					<div class="service__detail__tables" id="more_prices">
						<?foreach($arResult["PROPERTIES"]["HTML_TABLE_ENG"]["~VALUE"] as $t => $arTable):?>
							<div class="service__detail__tables__title"><?=$arResult["PROPERTIES"]["HTML_TABLE_ENG"]["DESCRIPTION"][$t]?></div>
							<div class="service__detail__tables__picture_wrapper">
								<?=$arTable["TEXT"]?>
							</div>
						<?endforeach?>
					</div>
				<?endif?>
			<?endif?>


			<div class="clear"></div>
		</div>
		<div class="col-xs-12 col-sm-4">
		</div>
		<div class="clear"></div>

	</div>
</div>