<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_DESC_LINE"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_DESC_LINE_DESC"),
	"ICON" => "/images/icon.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "aksoft",
		"CHILD" => array(
			"ID" => "machines",
			"NAME" => GetMessage("T_IBLOCK_DESC_NEWS"),
			"SORT" => 10,
		)
	),
);

?>