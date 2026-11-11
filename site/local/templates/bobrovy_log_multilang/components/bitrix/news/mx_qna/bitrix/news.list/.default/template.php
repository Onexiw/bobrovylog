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
		
		<div class="news_page__head__title">ВОПРОС-ОТВЕТ</div>

		<div class="news_page__head__social__title">Мы в соцсетях</div>
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
		
		<div class="clear"></div>
		
		<div class="qna__make">
			<div class="row">
				<div class="col-xs-12 col-md-6 visible-xs">
					<div class="qna__make__text">Вы можете задать вопрос нашим экспертам или прочитать ответы на вопросы других посетителей сайта.</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3 qna__make__link_wrap">
					<a href="" class="qna__make__link" data-toggle="modal" data-target="#question">Задать вопрос</a>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-5 hidden-xs">
					<div class="qna__make__text">Вы можете задать вопрос нашим экспертам или прочитать ответы на вопросы других посетителей сайта.</div>
				</div>
			</div>
		</div>

	</div>
</div>


  
<div id="qna-list" class="row qna__list">
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

<!--RestartBuffer-->
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?$day=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
	<?$month=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
	<?$year=substr($arItem["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>
	
	<div class="col-xs-12 col-md-8">
		<div class="qna__item">
			<div class="qna__item__question">
				<div class="qna__item__question__top">
					<div class="qna__item__question__top__avatar"></div>
					<div class="qna__item__question__top__name"><?=$arItem["PROPERTIES"]["NAME"]["VALUE"]?></div>
					<div class="qna__item__question__top__date">🗓 <?echo $day.' '.$m[$month].' '.$year?></div>				
				</div>
				<div class="qna__item__question__text">
					<?=(is_array($arItem["PROPERTIES"]["QUESTION"]["~VALUE"]) ? $arItem["PROPERTIES"]["QUESTION"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["QUESTION"]["~VALUE"])?>
				</div>
			</div>
			
			<div class="qna__item__answer">
				<div class="qna__item__answer__top">
					<div class="qna__item__answer__top__name">Администрация Фанпарка</div>
				</div>
				<div class="qna__item__answer__text">
					<div class="qna__item__answer__top__avatar"></div>
					<?=(is_array($arItem["PROPERTIES"]["ANSWER"]["~VALUE"]) ? $arItem["PROPERTIES"]["ANSWER"]["~VALUE"]["TEXT"] : $arItem["PROPERTIES"]["ANSWER"]["~VALUE"])?>
				</div>
				<div class="qna__item__answer__bottom">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="qna__item__answer__bottom__link">На страницу вопроса</a>
				</div>
			</div>
		
		</div>
	</div>
	
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
                      <a class="ajax-pager-link" data-wrapper-class="qna__list" href="%s"></a>
                  </div>',
        $url);
}
?>
<script>
$(document).ready(function(){

});
</script>
<!--RestartBuffer-->

</div>
<div class="clear"></div>
