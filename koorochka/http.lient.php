<?
/**
 * Test HttpClient
 * 23.06.2019 19:51
 * https://mrcappuccino.ru/blog/post/work-with-http-bitrix-d7
 * https://www.intervolga.ru/blog/projects/d7-analogi-lyubimykh-funktsiy-v-1s-bitriks/
 * https://dev.1c-bitrix.ru/api_d7/bitrix/main/web/httpclient/__construct.php
 */
use Bitrix\Main\Web\HttpClient;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$arParams = array(
    "URL" => "http://dev.vpcoffee.ru/koorochka/test.php",
    "URL_TEST" => "/koorochka/test.php",
    "METHOD" => HttpClient::HTTP_POST
);


$arResult = array(
    "TEST" => "Test HttpClient",
    "RESULT" => null,
    "STATUS" => null,
    "TYPE" => null,
);

$httpClient = new HttpClient(array("version" => "1.1", "socketTimeout" => 30, "streamTimeout" => 30, "redirect" => true, "redirectMax" => 5));

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