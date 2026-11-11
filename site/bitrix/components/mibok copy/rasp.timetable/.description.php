<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_NEWS_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_NEWS_DESCRIPTION"),
	"ICON" => "/images/news_all.gif",
	"COMPLEX" => "Y",
    "SORT" => 10,
	"PATH" => array(
		"ID" => "mibok",
        "NAME" => GetMessage("T_CREATER"),
		"CHILD" => array(
			"ID" => "timetable",
			"NAME" => GetMessage("T_IBLOCK_DESC_NEWS"),
			"SORT" => 10,
		),
	),
);

?>