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

<!--Мобильные камеры-->
<div class="row">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="col-xs-12 col-sm-4">
		<a href="" class="mobile_webcam" data-toggle="modal" data-target="#mobile_webcam" mobile_sors="<?=$arItem["PROPERTIES"]["STREAM"]["VALUE"]?>">
			<div class="lazyload webcam__picture" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/blank_360_270.png">
				<div class="webcam__picture__play">
					<svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M33 66C14.8 66 0 51.2 0 33C0 14.8 14.8 0 33 0C51.2 0 66 14.8 66 33C66 51.2 51.2 66 33 66Z" fill="white"/>
					<path d="M25 20L44 33.5L25 47L25 20Z" fill="#005481"/>
					</svg>
				</div>	
			</div>
			<div class="webcam__title">
				<?=LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"]?>
			</div>
		</a>
	</div>
<?endforeach;?>

</div>

<script>
	//mobile webcam 	
		$('.mobile_webcam').on('click', function(e){
			e.preventDefault();
			var sors = $(this).attr('mobile_sors');
			console.log(sors);
			$('.modal_webcam video').attr('src', sors);
		})
		
		var videoEl = document.getElementsByTagName('video')[0];
		
		$('#mobile_webcam').on('hidden.bs.modal', function (e) {
		  videoEl.stop();
		});
	
		//mobile webcam end

</script>

<!--modal MOBILE webcam-->
<div class="modal fade" id="mobile_webcam" tabindex="-1" role="dialog">

	<div class="modal_webcam">
	
	    
    <video width="640" height="400" controls="controls" src="">
	
	
	</div>

	 <div class="modal_block__top__close" data-dismiss="modal">
			  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path class="modal_block__top__close__round" d="M11 21C5.44906 21 1 16.5509 1 11C1 5.44906 5.44906 1 11 1C16.5509 1 21 5.44906 21 11C21 16.5509 16.5509 21 11 21Z" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
					<path class="modal_block__top__close__cross" d="M7 6.99481L15.0052 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
					<path class="modal_block__top__close__cross" d="M15.0052 6.99481L7 15" stroke="#E0E0E0" stroke-width="2" stroke-miterlimit="10"/>
				</svg>
		  </div>
</div>