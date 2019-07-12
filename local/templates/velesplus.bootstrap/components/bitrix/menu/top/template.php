<?
/**
 * @var array $arResult
 * @var array $arParams
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<nav class="navbar navbar-inverse hidden-xs"
     data-loader="<?=Loc::getMessage("MENU_LOADER")?>"
     data-additionally="<?=Loc::getMessage("MENU_ADDITIONALLY")?>">
    <div class="container-fluid">

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse"
             id="veles-top-menu">
            <ul class="nav navbar-nav">

                <?foreach($arResult as $item):?>
                    <li<?=$item["SELECTED"] ? ' class="active"' : ""?>><a href="<?=$item["LINK"]?>"><?=$item["TEXT"]?></a></li>
                <?endforeach;?>


            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>