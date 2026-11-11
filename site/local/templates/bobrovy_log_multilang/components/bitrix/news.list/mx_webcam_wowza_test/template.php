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
		<link rel="stylesheet" href="https://unpkg.com/video.js@8.5.0/dist/video-js.css">
		<script type="text/javascript" src="https://unpkg.com/video.js@8.5.0/dist/video.js"></script>
		<script src="https://unpkg.com/videojs-contrib-hls@5.15.0/es5/videojs-contrib-hls.js"></script>
					
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
                                                        <?=LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"]?>
                                                </div>
                                        </a>
                         	</div>

                     	<?endforeach;?>
                </div>

                <script>
                                //desktop webcam
                                var player = video.js('example-video'),
                                
                                var sors = $(this).attr('sors');

                                        player.source = {
                                           sources: [{
                                                        src: sors,
                                                        type: 'application/x-mpegurl'
                                                }]
                                        };
                                        player.play();

                                $('#webcam').on('hidden.bs.modal', function (e) {
                                  player.stop();
                                })
                                //desktop webcam end
                </script>
