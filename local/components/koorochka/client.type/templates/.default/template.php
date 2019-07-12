<?
/**
 * Povered by artem@koorochka.com
 * 20.06.2019 19:52
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
?>

<div class="padding-top-20">
    <h3><?=Loc::getMessage("CLIENT_TYPE_TITLE")?></h3>
    <form action="/order/" method="post">

        <div class="checkbox">
            <label>
                <input type="radio"
                       name="user"
                       value="client"
                       onchange="userChoose()"><?=Loc::getMessage("CLIENT_TYPE_CLIENT")?></label>
        </div>

        <div class="checkbox">
            <label>
                <input type="radio"
                       name="user"
                       value="guest"
                       onchange="order_step()"><?=Loc::getMessage("CLIENT_TYPE_GUEST")?></label>
        </div>

        <div class="text-left">
            <input type="submit"
                   value="<?=Loc::getMessage("CLIENT_TYPE_SUBMIT")?> →"
                   class="btn btn-primary"
                   disabled="disabled" />
        </div>
    </form>
</div>