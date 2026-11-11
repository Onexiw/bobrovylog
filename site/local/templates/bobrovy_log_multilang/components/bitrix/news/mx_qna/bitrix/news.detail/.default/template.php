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
		
		<a href="/qna/" class="news_page__head__back">&#8592; ВОПРОСЫ</a>

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

<div id="qna-list" class="row qna__list">
	<div class="qna__title"><?=$arResult["NAME"]?></div>
	
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


	<?$day=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 0, 2)?>
	<?$month=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 3, 2)?>
	<?$year=substr($arResult["PROPERTIES"]["DATE"]["VALUE"], 6, 4)?>
	
	<div class="col-xs-12 col-md-8">
		<div class="qna__item">
			<div class="qna__item__question">
				<div class="qna__item__question__top">
					<div class="qna__item__question__top__avatar"></div>
					<div class="qna__item__question__top__name"><?=$arResult["PROPERTIES"]["NAME"]["VALUE"]?></div>
					<div class="qna__item__question__top__date">🗓 <?echo $day.' '.$m[$month].' '.$year?></div>				
				</div>
				<div class="qna__item__question__text">
					<?=(is_array($arResult["PROPERTIES"]["QUESTION"]["~VALUE"]) ? $arResult["PROPERTIES"]["QUESTION"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["QUESTION"]["~VALUE"])?>
				</div>
			</div>
			
			<div class="qna__item__answer">
				<div class="qna__item__answer__top">
					<div class="qna__item__answer__top__name">Администрация Фанпарка</div>
				</div>
				<div class="qna__item__answer__text">
					<div class="qna__item__answer__top__avatar"></div>
					<?=(is_array($arResult["PROPERTIES"]["ANSWER"]["~VALUE"]) ? $arResult["PROPERTIES"]["ANSWER"]["~VALUE"]["TEXT"] : $arResult["PROPERTIES"]["ANSWER"]["~VALUE"])?>
				</div>
				<div class="qna__item__answer__bottom">
<!-- 					<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="qna__item__answer__bottom__link">На страницу вопроса</a> -->
				</div>
			</div>
		
		</div>
	</div>
	

</div>
<div class="clear"></div>
