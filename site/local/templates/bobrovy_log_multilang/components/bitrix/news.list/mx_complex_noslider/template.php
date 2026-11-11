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

    <div class="noslider-wrapper">
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<?//d($arItem)?>
        <div class="complex__item">
	        
			    <div class="complex__item__pict">
				    
				    <img src="<?=SITE_TEMPLATE_PATH?>/images/square.png" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" class="complex__item__pict__img lazyload">

				    <div class="complex__item__pict__title"><?=LANGUAGE_ID == "en" ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"]?></div>
				    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="complex__item__pict__link"><?=GetMessage('know_more')?></a>
			    </div>  

	        <div class="complex__item__info">
		       	<div class="complex__item__info__text"><?=LANGUAGE_ID == "en" ? (is_array($arItem["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) ? $arItem["PROPERTIES"]["TEXT_ENG"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["TEXT_ENG"]["~VALUE"]) :$arItem["PREVIEW_TEXT"]?></div>
		       	<div class="complex__item__info__services">
			       	<div class="row">
				       	<?$s=0;?>
				      	<?foreach($arItem["SERVICES"] as $k => $arService):?>
					      	<?if($s <= 3):?>
										<div class="col-xs-6">
											
											<div class="services__icon lazyload" data-src="<?=$arService["PICTURE"]?>"></div>
											<a href="<?=$arService["DETAIL_PAGE_URL"]?>" class="services__block">
												<div class="services__block__title"><?=LANGUAGE_ID == "en" ? $arService["NAME__ENG"] : $arService["NAME"]?></div>
												<div class="services__block__price"><?=GetMessage("stoimost")?></div>
											</a>
										</div>		
										<?$s++?>
										<?if($s%2 == 0):?>
											<div class="clear"></div>
										<?endif?>	
									<?endif?>	      		
				      	<?endforeach?>
			      	</div>
			      </div>
		      </div>

		    
        </div>
			
			<?endforeach;?>
		</div>
  
  <div class="row">
	  <div class="col-xs-11 col-xs-offset-1 complex__border"></div>
	</div>
	
