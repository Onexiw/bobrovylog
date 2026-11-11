<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<?php
//echo '<pre>';
//print_r($arResult);
//echo '</pre>';
//?>

<ul class="webcam-list">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <li>
            <h1><?= LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"] ?></h1>
            <div id="<?= $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"]?>" class="camera_desktop"></div>


            <script>
                var player = new Playerjs({
                    id: "<?= $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] ?>",
                    file: "<?= $arItem['PROPERTIES']['STREAM']['VALUE'] ?>",
                    poster: "<?= $arItem['DETAIL_PICTURE']["SRC"]?>"
                });
            </script>


        </li>
    <? endforeach; ?>
</ul>


<!--Камеры для мобильных-->
<div class="row mobile_cameras">
    <script type="text/javascript"
            src="https://cam.bobrovylog.ru/live/kkd2-bot.stream/playlist.m3u8"></script>

    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <? //d($arItem)?>
        <div class="col-xs-12 col-sm-4">
            <div class="webcam" data-toggle="modal" data-target="#webcam_wowza"
                 sors="<?= $arItem["PROPERTIES"]["STREAM"]["VALUE"] ?>">
                <div class="lazyload webcam__picture"
                     data-src="<?= $arItem["DETAIL_PICTURE"]["SRC"]?>">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/blank_360_270.png">
                    <div class="webcam__picture__play">
                        <svg width="66" height="66" viewBox="0 0 66 66" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M33 66C14.8 66 0 51.2 0 33C0 14.8 14.8 0 33 0C51.2 0 66 14.8 66 33C66 51.2 51.2 66 33 66Z"
                                  fill="white"/>
                            <path d="M25 20L44 33.5L25 47L25 20Z" fill="#005481"/>
                        </svg>
                    </div>
                </div>
                <div class="webcam__title">
                    <?= LANGUAGE_ID == 'en' ? $arItem["PROPERTIES"]["NAME_ENG"]["VALUE"] : $arItem["NAME"] ?>
                </div>
            </div>
        </div>

    <? endforeach; ?>
</div>


<script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>


<script>
    //desktop webcam


    $('.webcam').on('click', function (e) {
        e.preventDefault();
        var sors = $(this).attr('sors');


        WowzaPlayer.create('playerElement',
            {
                "license": "PLAY2-kkaa7-j8XFZ-BD6mv-kaybk-3FTYC",
                "title": "",
                "description": "",
                "sourceURL": sors,
                "autoPlay": true,
                "volume": "75",
                "mute": false,
                "loop": false,
                "audioOnly": false,
                "uiShowQuickRewind": false
            }
        );


        //WowzaPlayer.play();
    })

    //$('#webcam_wowza').on('hidden.bs.modal', function (e) {
    //WowzaPlayer.stop();
    //})
    //desktop webcam end
</script>