<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?foreach($arResult['PERIOD_DAY_NO'] as $key => $item):?>
    <?if(isset($arResult['TABLE'][date('n',$item['tmp'])][date('j',$item['tmp'])])):?>
      	<?$c = array()?>
      	<?$c_id = array()?>
      <?foreach($arResult['TABLE'][date('n',$item['tmp'])][date('j',$item['tmp'])] as $arHour):?>
        <?foreach($arHour as $arLesson):?>
	        <?//d($arLesson["NAME"])?>
						
					<?
					$res = CIBlockElement::GetByID($arLesson["ID"]);
					if($ar_res = $res->GetNext()) {
					  //d($ar_res["IBLOCK_SECTION_ID"]);
	
						$sres = CIBlockSection::GetByID($ar_res["IBLOCK_SECTION_ID"]);
						if($sar_res = $sres->GetNext()) {
							if(!in_array($sar_res['NAME'], $c))
						  $c[] = $sar_res['NAME'];
						}
					  $c_id[$arLesson['ID']] = $sar_res['NAME'];

					}
					?>
        <?endforeach?>
      <?endforeach;?>
	    <?$arResult["SECTIONS"] = $c?>
	    <?$arResult["SECTIONS_ID"][] = $c_id?>
    <?endif;?>
<?endforeach;?>

<?foreach($arResult["SECTIONS_ID"] as $sec):?>
	<?//d($sec)?>
	<?foreach($sec as $id => $idsec):?>
		<?//d($id)?>
		<?$arResult["SECTIONS_ID_CLEAR"][$id] = $idsec;?>
	<?endforeach?>
	<?//$arResult["SECTIONS_IDS"][]?>
<?endforeach?>