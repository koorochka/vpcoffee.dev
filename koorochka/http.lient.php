<?
/**
 * Test HttpClient
 * 23.06.2019 19:51
 * https://mrcappuccino.ru/blog/post/work-with-http-bitrix-d7
 * https://www.intervolga.ru/blog/projects/d7-analogi-lyubimykh-funktsiy-v-1s-bitriks/
 */
use Bitrix\Main\Web\HttpClient;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$arParams = array(
    "URL" => "/koorochka/test.php",
    "URL_TEST" => "/koorochka/test.php"
);

$arResult = array(
    "TEST" => "Test HttpClient",
    "RESULT" => null,
    "STATUS" => null,
    "TYPE" => null,
);

$httpClient = new HttpClient();
//$httpClient->query($method, $url, $entityBody = null);

//$httpClient->setRedirect(true, 5);
$httpClient->setHeader("Content-Type","application/octet-stream");
$httpClient->post($arParams["URL"], array(
    "TEST" => "testing"
));

$arResult["RESULT"] = $httpClient->getResult();
$arResult["STATUS"] = $httpClient->getStatus();
$arResult["TYPE"] = $httpClient->getContentType();


d($arResult);


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>