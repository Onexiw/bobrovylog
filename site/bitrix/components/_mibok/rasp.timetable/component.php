<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Page\Asset; 

CJSCore::Init(array("jquery"));
CJSCore::Init(array("ajax"));


if($arParams["USE_FILTER"]=="Y")
{
	if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
		$arParams["FILTER_NAME"] = "arrFilter";
}
else
	$arParams["FILTER_NAME"] = "";

$arDefaultUrlTemplates404 = array(
	"news" => "",
	/*"search" => "search/",
	"rss" => "rss/",
	"rss_section" => "#SECTION_ID#/rss/",*/
	"detail" => "#ELEMENT_ID#/",
	/*"section" => "",*/
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
	"SECTION_ID",
	"SECTION_CODE",
	"ELEMENT_ID",
	"ELEMENT_CODE",
);

//if($arParams["SEF_MODE"] == "Y")
//{
	$arVariables = array();

	$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
	$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_FOLDER"],
		$arUrlTemplates,
		$arVariables
	);

	$b404 = false;
	if(!$componentPage)
	{
		$componentPage = "news";
		$b404 = true;
	}

	if(
		$componentPage == "section"
		&& isset($arVariables["SECTION_ID"])
		&& intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]
	)
		$b404 = true;

	if($b404 && CModule::IncludeModule('iblock'))
	{
		$folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
		if ($folder404 != "/")
			$folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
		if (substr($folder404, -1) == "/")
			$folder404 .= "index.php";

		if ($folder404 != $APPLICATION->GetCurPage(true))
		{
			\Bitrix\Iblock\Component\Tools::process404(
				""
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SHOW_404"] === "Y")
				,$arParams["FILE_404"]
			);
		}
	}

	CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

	$arResult = array(
		"FOLDER" => $arParams["SEF_FOLDER"],
		"URL_TEMPLATES" => $arUrlTemplates,
		"VARIABLES" => $arVariables,
		"ALIASES" => $arVariableAliases,
	);
/*}

 */

if($arParams['IS_BOOTSTRAP_JS'] == 'Y')
    Asset::getInstance()->addJs($componentPath.'/lib/js/bootstrap.min.js');
if(!isset($arParams['IS_OWL_JS']) || $arParams['IS_OWL_JS'] == 'Y')
    Asset::getInstance()->addJs($componentPath.'/lib/js/owl.carousel.min.js');
if($arParams['IS_PS_JS'] == 'Y')
    Asset::getInstance()->addJs($componentPath.'/lib/js/perfect-scrollbar.jquery.min.js');
if(!isset($arParams['IS_BOOTSTRAP_DP_JS']) || $arParams['IS_BOOTSTRAP_DP_JS'] == 'Y')
{
    Asset::getInstance()->addJs($componentPath.'/lib/js/moment.min.js');
    Asset::getInstance()->addJs($componentPath.'/lib/js/daterangepicker.js');
}

if($arParams['IS_BOOTSTRAP_CSS'] == 'Y')
    Asset::getInstance()->addCss($componentPath.'/lib/css/bootstrap.css');
if(!isset($arParams['IS_OWL_CSS']) || $arParams['IS_OWL_CSS'] == 'Y')
    Asset::getInstance()->addCss($componentPath.'/lib/css/owl.carousel.min.css');
if($arParams['IS_PS_CSS'] == 'Y')
    Asset::getInstance()->addCss($componentPath.'/lib/css/perfectscrollbar.css');
if(!isset($arParams['IS_BOOTSTRAP_DP_CSS']) || $arParams['IS_BOOTSTRAP_DP_CSS'] == 'Y')
    Asset::getInstance()->addCss($componentPath.'/lib/css/daterangepicker.css');

Asset::getInstance()->addJS($componentPath.'/lib/js/additional.min.js');


$this->IncludeComponentTemplate($componentPage);

?>