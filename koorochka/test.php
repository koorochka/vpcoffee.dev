<?
/**
 * Test Request
 * @var Cmain $APPLICATION
 */
use Bitrix\Main\Application;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$request = Application::getInstance();




$request = $request->getContext();

d($request->getServer()->getHttpHost()); // dev.vpcoffee.ru
d($request->getServer()->getRequestMethod()); // POST
d($request->getServer()->getServerAddr()); // 127.0.0.1
d($request->getServer()->getServerName()); // dev.vpcoffee.ru


$request = $request->getRequest();

d($request->getHttpHost()); // dev.vpcoffee.ru
d($request->getRequestUri()); // /koorochka/test.php
d($request->getPost("TEST")); // testing
while($param = $request->getPostList()->next())
{
    d($param);
}
d($request->toArray());

d(($request->isHttps() ? "https://" : "http://") . $request->getHttpHost() . SITE_DIR . "order/order_form.php");



require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>