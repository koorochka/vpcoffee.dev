<?
/**
 * Test Request
 */
use Bitrix\Main\Application;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$request = Application::getInstance();
$request = $request->getContext();
$request = $request->getRequest();

d($_REQUEST);


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>