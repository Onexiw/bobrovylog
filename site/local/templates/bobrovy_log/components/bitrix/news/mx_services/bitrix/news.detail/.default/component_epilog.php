<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["MON"] !="" || 
	$arResult["TUE"] !="" || 
	$arResult["WED"] !="" || 
	$arResult["THU"] !="" || 
	$arResult["FRI"] !="" || 
	$arResult["SAT"] !="" || 
	$arResult["SUN"] !=""
):?>

<?//d($arResult)?>
	
	<?
	$day_of_a_week = strtoupper(date("D"));
	$time_now = (int)date("H");
	
	//d($day_of_a_week);
	//d($time_now);
													
	if($arResult[$day_of_a_week]["FROM"] <= $time_now && $arResult[$day_of_a_week]["TO"] > $time_now) {
		$opened = 'Открыто';
		$openedClass = 'opened';
	} else {
		$opened =  'Закрыто';
		$openedClass = 'closed';
	}


	//d($opened);
	//d($openedClass);

	?>
		
	<script>
		$('.service__detail_side__work__status').html('<div class="service__detail_side__work__status__title">&#9654;Статус</div><div class="service__detail_side__work__status__value <?=$openedClass?>"><?=$opened?></div>');
	</script>
	
<?endif?>