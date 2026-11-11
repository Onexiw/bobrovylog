<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$lm = GetMessage("security");
$APPLICATION->SetTitle($lm);

//$APPLICATION->SetTitle("Безопасность");
?>



<div class="container-fluid just_page">
	<div class="row">
		<div class="col-xs-12 cookies_policy__head">
			<div class="news_page__head__title"><h1><?=GetMessage("security")?></h1></div>
	
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/include/about/bezopasnost_".LANGUAGE_ID.".php"
				)
			);?>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>