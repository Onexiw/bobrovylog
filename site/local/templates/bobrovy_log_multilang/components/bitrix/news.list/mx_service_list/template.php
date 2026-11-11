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
<div class="service_page">
	<div class="container-fluid">


        <div class="row">
            <div class="col-xs-12 news_page__head">
                <div class="news_page__head__title"><?= GetMessage("services"); ?></div>
                <div class="try">
                    <div class="news_page__head__social__title"><?= GetMessage("social"); ?></div>
                    <div class="news_page__head__social__links">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/social.php"
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				<div class="row news__page__list">
				<?//d($arResult["SECTIONS"])?>
				<?foreach($arResult["SECTIONS"] as $n => $arSection):?>
					<div class="services__name"><?=LANGUAGE_ID == 'en' ? $arResult["SECTIONS_EN"][$n][0] : $n?></div>
					<div class="clear"></div>
					<div class="row">
						<?$i=0?>
						<?foreach($arSection as $arItem):?>
							<div class="col-xs-12 col-sm-4 services__item">
								<?$file = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>            
								<div class="services__icon" style="background-image: url(<?=$file["src"]?>);"></div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="services__block">
									<div class="services__block__title"><?=LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"]?></div>
									<div class="services__block__price"><?=GetMessage("stoimost")?></div>
								</a>
							</div>
							<?$i++?>
							<?if($i%3 == 0):?>
								<div class="clear"></div>
							<?endif?>
						<?endforeach?>
					</div>
					
				<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
</div>