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

			<!--Десктоп камеры-->
		<div class="row">
			<link rel="stylesheet" type="text/css" href='https://cdn.myth.theoplayer.com/c4d439ed-aca6-48ba-bb34-9b8eb5cb1a2a/ui.css'>
			<script type='text/javascript' src='https://cdn.myth.theoplayer.com/c4d439ed-aca6-48ba-bb34-9b8eb5cb1a2a/THEOplayer.js'></script>
			
			<?foreach($arResult["ITEMS"] as $arItem):?>
				
				<div class="col-xs-12 col-sm-4">
					<a href="" class="webcam" data-toggle="modal" data-target="#webcam" sors="<?=$arItem["PROPERTIES"]["STREAM"]["VALUE"]?>">
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
							<?=$arItem["NAME"]?>
						</div>
					</a>
				</div>
				
			<?endforeach;?>
		</div>

		<script>
				//desktop webcam 	
				var element = document.querySelector('.theoplayer-container');
				var player = new THEOplayer.Player(element, {
					libraryLocation: 'https://cdn.myth.theoplayer.com/c4d439ed-aca6-48ba-bb34-9b8eb5cb1a2a/'
				});
			
				$('.webcam').on('click touchstart', function(e){
					e.preventDefault();
					var sors = $(this).attr('sors');
					
					player.source = {
						sources: [{
							src: sors,
							type: 'application/x-mpegurl'
						}]
					};	
					player.play();
				})
				
				$('#webcam').on('hidden.bs.modal', function (e) {
				  player.stop();
				})
				//desktop webcam end
		</script>
