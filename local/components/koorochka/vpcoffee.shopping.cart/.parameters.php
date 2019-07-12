<?
/**
 * Povered by artem@koorochka.com
 * 19.06.2019 19:52
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS"  =>  array(

		"CLIENT_REDIRECT"  =>  Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CLIENT_REDIRECT"),
			"TYPE" => "STRING",
			"DEFAULT" => "100",
		),
		"AJAX_MODE" => array()

	),
);
?>
