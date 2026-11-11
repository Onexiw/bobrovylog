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

				    <div class="complex__item__pict__title"><?=$arItem["NAME"]?></div>
				    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="complex__item__pict__link">Узнать больше</a>
			    </div>  

	        <div class="complex__item__info">
		       	<div class="complex__item__info__text"><?=$arItem["PREVIEW_TEXT"]?></div>
		       	<div class="complex__item__info__services">
			       	<div class="row">
				       	<?$s=0;?>
				      	<?foreach($arItem["PROPERTIES"]["SERVICES"]["VALUE"] as $k => $arService):?>
					      	<?if($s <= 3):?>
										<div class="col-xs-6">
											<?
											$res = CIBlockElement::GetByID($arService);
											if($ar_res = $res->GetNext()) {
											  $file = CFile::ResizeImageGet($ar_res['DETAIL_PICTURE'], array('width'=>116, 'height'=>116), BX_RESIZE_IMAGE_PROPORTIONAL, true);
											  $sevicesName = $ar_res["NAME"];
											  $sevicesUrl = $ar_res["DETAIL_PAGE_URL"];
											}?>
											<div class="services__icon lazyload" data-src="<?=$file["src"]?>"></div>
											<a href="<?=$sevicesUrl?>" class="services__block">
												<div class="services__block__title"><?=$sevicesName?></div>
												<div class="services__block__price">стоимость</div>
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
	
