<?
/**
 * Povered by artem@koorochka.com
 * 18.06.2019 19:52
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

// <editor-fold defaultstate="collapsed" desc="Envirloment">
use Bitrix\Main\Localization\Loc;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
Loc::loadLanguageFile(__FILE__);
$this->setFrameMode(true);
// </editor-fold>

d($arResult);
?>

<form action="/"
      method="post">

    <?=bitrix_sessid_post()?>

    <input type="text"
           name="step"
           value="1" />



    <input type="submit"
           name="prev"
           value="prev" />

    <input type="submit"
           name="next"
           value="next" />
</form>