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
<div class="alert_list">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?//d($arItem)?>

<?if(LANGUAGE_ID != "en"){
	$name = $arItem["NAME"];
	$text = $arItem["DETAIL_TEXT"];
} else {
	$name = $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"];
	$text = $arItem["PROPERTIES"]["TEXT_ENG"]["VALUE"];
}
?>

	<script>
		var event_name = "<?=$name?>";
		var event_text = "<?=$text?>";
		var event_date = "<?=$arItem["PROPERTIES"]["DATE"]["VALUE"]?>";
		var event_unix_date = "<?=strtotime($arItem["PROPERTIES"]["DATE"]["VALUE"])?>";
		//$unixDate = strtotime($date);

		<?
		$res = CIBlockSection::GetByID($arItem["PROPERTIES"]["OBJECT"]["VALUE"]);
		if($ar_res = $res->GetNext())
		  $nnn =  str_replace(' ', '',$ar_res['NAME']);
		?>
		var event_object = "<?=$nnn?>";
		
		$('.item-lesson[mx_name="'+event_object+'"][data-tmstmp="'+event_unix_date+'"]').append('<a class="item-lesson__modal" data-toggle="modal" data-target="#lesson_modal" descr="'+event_text+'">'+event_name+'</a>');
	</script>
	
<?endforeach;?>

	<div class="modal fade mibok-modal" id="lesson_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
	          <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			        <h4 class="modal-title"></h4>
			      </div>
			      <div class="modal-body"></div>
          </div>
      </div>
  </div>
</div>

<script>
	$('.item-lesson__modal').on('click', function(){
		var mname = $(this).text();
		var descr = $(this).attr('descr');
		$('#lesson_modal .modal-title').text(mname);
		$('#lesson_modal .modal-body').text(descr);
	});
</script>