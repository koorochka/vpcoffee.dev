<?
/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if(empty($arParams["TITLE_LINK"])):?>
    <b class="title-brown"><?=$arParams["TITLE"]?></b>
<?else:?>
    <a href="<?=$arParams["TITLE_LINK"]?>" class="title-brown"><?=$arParams["TITLE"]?></a>
<?endif;?>
<br>
<br>
<ul class="leftm">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
    <?endforeach;?>
</ul>
