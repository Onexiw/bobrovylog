<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?$curPage = $APPLICATION->GetCurPage(true);?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/BebasNeue_Bold/fonts.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fonts/CeraPro/stylesheet.css");?>
  <? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/fonts/Tinkoff_Sans/fonts.css"); ?>

  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/bootstrap-3.3.7/css/bootstrap.min.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/bootstrap-3.3.7/css/bootstrap-theme.min.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/swiper-4.4.5/css/swiper.min.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox_3/jquery.fancybox.min.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/jquery-ui-1.12.1.custom/jquery-ui.min.css");?>
  <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/formcheck/style.css");?>

  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/is.mobile.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-ui-1.12.1.custom/jquery-ui.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bootstrap-3.3.7/js/bootstrap.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/swiper-4.4.5/js/swiper.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/lazyload.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.dotdotdot.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox_3/jquery.fancybox.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/formcheck/is.mobile.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/formcheck/jquery.maskedinput.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/formcheck/formcheck.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/imagesloaded.pkgd.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/masonry.pkgd.min.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.history.js");?>
  <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/mx_script.js");?>

  <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/playerjs.js"); ?>

	<?$APPLICATION->ShowHead();?>
<?$APPLICATION->AddHeadScript('https://sale.moipass.ru/external.script.js');?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        if (typeof WPInit !== 'undefined') {
            WPInit({
                id: 537,
				//                groupid: ["20214214","20975470"],  
				//groupid: 20214214,  
				onlytab: ["service","rewrite"], 
				//onlytab: ["service"], 
                forcetab: "service",
                height: 700,
                width: 1200,
                type: 'modal',
                nopromo: true,
                locale: 'ru'
            });
        }
    }, 500);
});
</script>

<?if($_COOKIE["color_theme"] == 'leto') {
	$color = 'leto';
	$btn_color = 'black_color';
} elseif($_COOKIE["color_theme"] == 'zima') {
	$color = 'zima';
	$btn_color = 'white_color';
} else {
	//получаем текущую дату
	$today = new DateTime();

	//присвоим начало сезонов
	$summer = new DateTime('April 16'); //начало лета
	$winter = new DateTime('November 16'); //начало зимы

	switch(true) {
		case $today >= $summer && $today < $winter:
    	$_COOKIE["color_theme"] = 'leto';
		  $color = 'leto';
		  break;
		default:
    	$_COOKIE["color_theme"] = 'zima';
		  $color = 'zima';
	}
}?>

<?
require_once 'Mobile-Detect/Mobile_Detect.php';
$detect = new Mobile_Detect;
if ($detect->isMobile() || $detect->isTablet()) {
	$_SESSION["device"] = "m";
	$devic = "m";
} else {
	$_SESSION["device"] = "d";
	$devic = "d";
}
?>




<?//=LANGUAGE_ID?>
<!--language-->
<?if(LANGUAGE_ID == 'en'):?>
	<script>
		$(document).ready(function(){
			var mx_get = window.location.search;
			console.log(mx_get);

			if(mx_get != "") {
				mx_get = mx_get.replace("&lng=en", '');
				mx_get = mx_get.replace("?lng=en", '');

				if(mx_get != "") {
					History.pushState(null, null, mx_get+"&lng=en");
				} else {
					History.pushState(null, null, mx_get+"?lng=en");
				}
			} else {
				History.pushState(null, null, "?lng=en");
			}
		});
	</script>
<?endif?>

</head>
<body class="<?=$color?> <?=$lng?>">

	<?//include $_SERVER["DOCUMENT_ROOT"]."/include/lang/".LANGUAGE_ID."/mess.php";?>

	<?//IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/include/lang/".LANGUAGE_ID."/mess.php");?>
	<?//=GetMessage("services");?>
	<!-- Top.Mail.Ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "3788617", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = "https://top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "tmr-code");
</script>
<noscript><div><img src="https://top-fwz1.mail.ru/counter?id=3788617;js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript>
<!-- /Top.Mail.Ru counter -->
	<div class="wrapper">
	<? if ($USER->IsAdmin()): ?>
    <style>
        .tablebodytext {
            display: none;
        }
        #bx-panel {
            display: none !important;
        }
        #bx-panel.vis {
            display: block !important;
        }
        .fixedBitrixPanel {
            position: fixed;
            z-index: 1000000000;
            width: 100%;
        }
        .fixedBitrixPanel .showPanel {
            background: scroll #4A525B url(/bitrix/js/main/core/images/panel/top-panel-sprite-2.png) repeat-x 0 0 !important;
            height: 25px;
            padding: 0 10px;
            font: normal normal bold 12px/25px "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            color: #DDE7E9 !important;
            cursor: pointer;
            display: inline-block;
            border-radius: 0 0 10px 10px;
            left: 50%;
            margin-left: -40px;
            position: absolute;
            top: 100%;
        }
        .fixedBitrixPanel .showPanel:hover {
            background: scroll rgba(0, 0, 0, 0) url(/bitrix/js/main/core/images/panel/top-panel-sprite-2.png) 0 -1173px !important;
        }
    </style>
<? endif; ?>
<?
$showPanel = false;
$userGroup = $USER->GetUserGroupArray();
$serializeGroup = COption::GetOptionString("main", "show_panel_for_users");
$group = unserialize($serializeGroup);
foreach ($userGroup as $val) {
    if (in_array("G" . $val, $group)) {
        $showPanel = true;
        break;
    }
}
if ($USER->IsAdmin() || $showPanel):?>
    <div class="fixedBitrixPanel">
        <? $APPLICATION->ShowPanel() ?>
        <div class="showPanel">
            <div>Панель управления</div>
            <div style="display:none;">Скрыть панель</div>
        </div>
        <script>
            $(document).ready(function () {
                $('.showPanel').click(function () {
                    $('#bx-panel').toggleClass('vis');
                    $('.showPanel div').toggle();
                });
            })
        </script>
    </div>
<? endif; ?>


	<div class="fake_header"></div>
	<div class="content" id="top">