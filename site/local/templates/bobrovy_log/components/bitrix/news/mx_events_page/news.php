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
		
		<div class="news_page__head__title">События</div>

		<div class="news_page__head__social__title">Мы в соцсетях</div>
		<div class="news_page__head__social__links">
			<div class="news_main__social__links__item">
				<a href="https://www.facebook.com/bobrovylog" class="news_main__social__links__item__icon item__icon_fb"></a>
			</div>
			<div class="news_main__social__links__item">
				<a href="https://vk.com/bobrovylog" class="news_main__social__links__item__icon item__icon_vk"></a>
			</div>
			<div class="news_main__social__links__item">
				<a href="https://www.instagram.com/bobrolog/" class="news_main__social__links__item__icon item__icon_inst"></a>
			</div>
		</div>

	</div>
</div>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
	),
	$component
);
?>
<br />
<?endif?>

<div class="event_filter">
	<div class="event_filter__title">Фильтр</div>

	<div class="event_filter__title_m collapsed" data-toggle="collapse" href="#event_filter__drop" aria-expanded="false" aria-controls="event_filter__drop">Фильтр</div>
	
	 
	
	<div class="event_filter__drop collapse" id="event_filter__drop">
		<div class="event_filter__block">
			<div class="dropdown">
			  <div id="dropdown_year" class="dropdown__current" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" cur="<?=date('Y')?>">
			    <?=date('Y')?>
			    <span class="caret">
				    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.2092 0.658691L5.96414 5.64852L10.7191 0.658691" stroke="#CECFD1"/>
						</svg>
			    </span>
			  </div>
			  <ul class="dropdown-menu" aria-labelledby="dropdown_year">
					<?$d=date('Y')+1;
						$e = $d-10?>
					<?while ($e < $d):?>
				    <li class="event_filter__element"><?=$d?></li>
						<?$d--?>
			    <?endwhile?>
			  </ul>
			</div>
			
			<div class="dropdown">
					<?$mw = array(
						'01' => 'Январь',
						'02' => 'Февраль',
						'03' => 'Март',
						'04' => 'Апрель',
						'05' => 'Май',
						'06' => 'Июнь',
						'07' => 'Июль',
						'08' => 'Август',
						'09' => 'Сентябрь',
						'10' => 'Октябрь',
						'11' => 'Ноябрь',
						'12' => 'Декабрь',
					);
					?>
			  <div id="dropdown_month" class="dropdown__current" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" cur="<?=$mw[date('m')]?>">
			    
			    <?=$mw[date('m')]?>
			    <span class="caret">
				    <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.2092 0.658691L5.96414 5.64852L10.7191 0.658691" stroke="#CECFD1"/>
						</svg>
			    </span>
			  </div>
			  <ul class="dropdown-menu" aria-labelledby="dropdown_month">
					<?foreach($mw as $arMw):?>
				    <li class="event_filter__element"><?=$arMw?></li>
			    <?endforeach?>
			  </ul>
			</div>
			
	<!-- 		<input type="text" name="filter_date" class="event_filter__date" placeholder="Дата. Или через запятую неколько дат"> -->
		</div>
		
		<div class="event_filter__btns">
			<a href="/events/" class="event_filter__all"><span><svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.66666 6C2.66666 2.68629 5.35295 0 8.66666 0C11.9804 0 14.6667 2.68629 14.6667 6C14.6667 9.31371 11.9804 12 8.66666 12C6.99999 12 5.51332 11.3333 4.42666 10.24L5.37332 9.29333C6.21332 10.14 7.37999 10.6667 8.66666 10.6667C11.244 10.6667 13.3333 8.57733 13.3333 6C13.3333 3.42267 11.244 1.33333 8.66666 1.33333C6.08933 1.33333 3.99999 3.42267 3.99999 6H5.99999L3.30666 8.68667L0.666656 6H2.66666Z" fill="#F2994A"/>
</svg>
</span>Показать все</a>	
			<a href="" class="event_filter__action">Поиск</a>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?
GLOBAL $arrFilterCurDate;
$arrFilterCurDate['>=PROPERTY_DATE'] = date('Y-m-d');//выводим события больше равно текущей дате
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => 'arrFilterCurDate',
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
	),
	$component
);?>
