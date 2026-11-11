<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

?>

<div class="container-fluid just_page">
	<div class="row">
		<div class="col-xs-12 cookies_policy__head">
			<div class="news_page__head__title"><h1><?=GetMessage("error_404")?></h1></div>
	
		</div>
	</div>
</div>
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>